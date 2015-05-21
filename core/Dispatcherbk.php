<?php

/**
 * Le dispatcher fait le lien entre la requête de l'utilisateur et le serveur afin de le rediriger vers la bonne URL
 */
class Dispatcher {

    public $request;

    /**
     * Construction de l'object Dispatcher et définition du contrôler/actions/params par la requète de l'utilisateur
     * @param none
     * @return none
     * */
    function __construct() {
        $this->request = new Request();
        try {
            Router::parse($this->request->url, $this->request);
            $controller = $this->loadController();
            if(!in_array($this->request->action, get_class_methods($controller))){
                $this->error('Le controller'.$this->request->controller.'n\'a pas de méthode'.$this->request->action);
            }
            call_user_func_array(array($controller, $this->request->action), $this->request->params);
            $controller->render($this->request->action);
          
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    
    /**
     * 404
     * Charge un faux controlleur et lui fait rendre la vue 404.php
     * @param String $message
     */
    function error($message) {
        header('HTTP/1.0 404 NOT FOUND');
        $controller=new Controller($this->request);
        $controller->set('message',$message);
        $controller->render('/errors/404');
        die();
    }

    /**
     * Charge le bon controlleur 
     * @param none
     * @return FILE 
     * */
    function loadController() {
        $name = ucfirst($this->request->controller) . 'Controller';
        $file = ROOT . DS . 'controller' . DS . $name . '.php';
        require $file;
        return new $name($this->request);
    }

}
