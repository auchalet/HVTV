<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of ProjetController
 *
 * @author Alexis
 */
class ActusController extends Controller {

    
    public function index() {
        $perPage=1;
        $this->loadModel('Post');
        $conditions = array(
                'online' => 1,
                'type' => 'actu'
        );
        $d['actus'] = $this->Post->find(array(
            'conditions' => $conditions,
            'limit' => ($perPage*($this->request->page-1)).','.$perPage
                )
           );
        $d['total'] = $this->Post->findCount($conditions);
        $d['pages']=  ceil($d['total']/$perPage);
        
        $this->set($d);
    }
    
    
    /**
     * Action view : rend la page n° $id
     * Contrôle l'url : si aucune page n'est précisée : appelle 404
     * Charge un tableau regroupant la page demandée et toutes les pages.
     * @param type $id
     */
    public function view($id) {
        $this->loadModel('Post');
        $conditions=array(
                'online' => 1,
                'id' => $id,
                'type' => 'actu'
            
        );
        $d['actus'] = $this->Post->findFirst(array(
            'conditions' => $conditions
        ));
        
        if (empty($d['actus'])) {
            $this->e404('Page Introuvable');
        }
        $this->set($d);
        
        
    }

}
