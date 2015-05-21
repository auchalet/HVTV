<?php

/**
 * Classe PagesControlleur
 * Hérite de Controller :
 * render($view)
 * set($key, $value=null)
 */
class PagesController extends Controller {

    public function view($id) {
        $this->loadModel('Post');
        $d['page']=$this->Post->findFirst(array(
            'conditions'    =>  array(
                        'id'    =>  $id
            )
        ));
        if(empty($d['page'])){
            $this->e404('Page Introuvable');
        }
        
        $d['pages']=  $this->Post->find(array(
                            'conditions' => array('type' =>  'page')
                         ));
        
        $this->set($d);
        
    }
    

    

}

