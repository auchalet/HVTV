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
    public $pk='id';

    /**
     * Se connecte à la base de données $conf avec les attributs de conf.php
     * @return boolean
     */
    public function __construct() {
        
        //Je me connecte à la base
        //Initialisation de quelques variables
        if($this->table==false){
            $this->table = strtolower(get_class($this)).'s';
        }
        $conf = Conf::$database[$this->conf];
        if (isset(Model::$connections[$this->conf])) {
            $this->db = Model::$connections[$this->conf];
            return true;
        }
        try {
            $pdo = new PDO(
                    'mysql:host='.$conf['host'].';dbname='.$conf['database'].';',$conf['login'],$conf['password'], array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
                    )
            );
            //var_dump($pdo);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            Model::$connections[$this->conf] = $pdo;
            $this->db = $pdo;
            //var_dump($pdo);
        } catch (Exception $e) {
            if (Conf::$debug > 1) {
                die('Impossible de se connecter à la base de données');
            }
        }
        

    }

    /**
     * 
     */
    public function find($req) {
        //var_dump($req);
        $sql='SELECT '; 
        //var_dump($req);
        
        if(isset($req['fields'])){
            if(is_array($req['fields'])){
                $sql .= implode(', ',$req['fields']);
            }
            else{
                $sql .= $req['fields'];
            }
        }
        else{
            $sql .= '*';
        }

        $sql .=' FROM '.$this->table.' AS '.get_class($this).' ';    
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

                    $cond[]="$k=$v";
                }
                $sql .= implode(' AND ', $cond);
            }
        }
        
        if(isset($req['limit'])){
            $sql .=' LIMIT '.$req['limit'];
        }
        
        //var_dump($sql);

        $pre=$this->db->prepare($sql);
       //var_dump($pre);
        $pre->execute();
        //var_dump($pre);
        return $pre->fetchAll(PDO::FETCH_OBJ);
        
    }

    
    /**
     * 
     */
    public function findFirst($req){
        return current($this->find($req));
    }
    
    
    public function findCount($conditions){
        //var_dump($conditions);
        $res=$this->findFirst(array(
            'fields' => 'COUNT('.$this->pk.') as count',
            'conditions' => $conditions
        ));
        //var_dump($res);
        return $res->count;
        
    }
    
}


