<?php

/**
 * Classe PagesControlleur
 * Hérite de Controller :
 * render($view)
 * set($key, $value=null)
 */
class PagesController extends Controller {

    /**
     * Action view : rend la page n° $id
     * Contrôle l'url : si aucune page n'est précisée : appelle 404
     * Charge un tableau regroupant la page demandée et toutes les pages.
     * @param type $id
     */
    public function view($id) {
        $this->loadModel('Post');
        $d['page']=$this->Post->findFirst(array(
            'conditions'    => array(
                'online'    =>  1,
                'id'    =>  $id,
                'type'  =>  'page'
            )
        ));
        if(empty($d['page'])){
            $this->e404('Page Introuvable');
        }
        
        
        $this->set($d);
        
    }
    
    /**
     * Permet de récupérer les pages pour le menu
     */
    public function getMenu(){
        $this->loadModel('Post');
        //var_dump($this);
        return $this->Post->find(array(
            'conditions'    => array(
                'online'    =>  1,
                'type'  =>  'page'
                )
        ));
        
        
    }
    

    

}

