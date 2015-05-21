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
            //debug($this);
            $controller = $this->loadController();
            if(!in_array($this->request->action, array_diff(get_class_methods($controller),get_class_methods('Controller')))){
                $this->error('Le controller'.$this->request->controller.'n\'a pas de méthode'.$this->request->action);
            }
            call_user_func_array(array($controller, $this->request->action), $this->request->params);
            $controller->render($this->request->action);
          
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    
    /**
     * Rend une page d'erreur avec le $message
     * Charge un faux controlleur qui appelle la fonction d'erreur correspondant
     * @param String $message
     */
    function error($message) {
        $controller=new Controller($this->request);
        $controller->e404($message);
        
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
        //var_dump($file);
        require $file;
        return new $name($this->request);
    }

}
