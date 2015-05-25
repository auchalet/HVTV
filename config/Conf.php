<?php

/**
 * Classe de configuration pour la connexion à DB etc.
 */
class Conf {
    
    static $debug = 1;
    
    static $database = array(
            'default' => array(
                'host' => 'localhost',
                'database' => 'hvtv',
                'login' => 'root',
                'password' => ''
                )
            );
    
}



/**
 * Routes
 */
Router::connect('actus/:slug/:id','actus/view/id:([0-9]+)/slug:([0-9a-z-]+)');
Router::connect('/', 'actus/index');
//Router::connect('blog/:action', 'actus/:action');
