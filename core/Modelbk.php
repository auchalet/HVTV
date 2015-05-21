<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model
 *
 * @author Alexis
 */
class Model {

    static $connections = array();
    public $conf = 'default';
    public $table = 'false';
    public $db;

    /**
     * Se connecte à la base de données $conf avec les attributs de conf.php
     * @return boolean
     */
    public function __construct() {
        
        //Je me connecte à la base
        $conf = Conf::$database[$this->conf];
        if (isset(Model::$connections[$this->conf])) {
            $this->conf = Model::$connections[$this->conf];
            return true;
        }
        try {
            $pdo = new PDO(
                    'mysql:host=' . $conf['host'] . ';dbname=' . $conf['database'] . ';', $conf['login'], $conf['password'], array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
                    )
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            Model::$connections[$this->conf] = $pdo;
            $this->db = $pdo;
        } catch (Exception $e) {
            if (Conf::$debug > 1) {
                die('Impossible de se connecter à la base de données');
            }
        }
        
        //Initialisation de quelques variables
        if($this->table==false){
            $this->table = strtolower(get_class($this)).'s';
        }
    }

    /**
     * 
     */
    public function find($req) {
        $sql='SELECT * FROM '.$this->table.' as '.get_class($this).' ';
        
        
        //Construction de la condition
        if(isset($req['conditions'])){
            $sql.='WHERE ';
            if(!is_array($req['conditions'])){
                $sql .=$req['conditions'];
            }
            else {
                $cond=array();
                foreach($req['conditions'] as $k => $v){
                   if(!is_numeric($v)){
                       $v='"'.$v.'"';
                   }
                    $cond[]=$k.'='.$v;
                }
                $sql .= implode(' AND ', $cond);
            }
        }
        $pre=  $this->db->prepare($sql);
        $pre->execute();
        return $pre->fetchAll(PDO::FETCH_OBJ);
        
    }

    
    /**
     * 
     */
    public function findFirst($req){
        return current($this->find($req));
    }
}


