<?php

/**
* 
*/
class Router 
{   
	
    static $routes = array();

    /**
     * Enlève les éventuels espaces et les '/' eux extremités de l'url
     * params[0]     '/'      controller  
     * params[0]     '/'      action
     * etc.
     * @param String $url No comment
     * @param Request $request controller/action/
     * @return bool
     * */
    static function parse($url, $request) {
        //Si l'url est vide, l'url est vide
        if(empty($url)){
            $url=  Router::$routes[0];
        }
        else{
            //Pour chaque route, va récupérer les variables de l'URL pour les paramètres de la route
            foreach (Router::$routes as $v) {
                //Si une route est trouvée, chargement du contrôleur, de l'action et des paramètres
                if (preg_match($v['catcher'], $url, $matches)) {
                    //debug($matches);
                    $request->controller = $v['controller'];
                    $request->action = $v['action'];
                    $request->params = array();
                    foreach ($v['params'] as $k => $v) {
                        $request->params[$k] = $matches[$k];
                    }
                    //debug($request);
                    return $request;
                }
            }
            
        }
        //$url=trim($url,'/');
        //$params=explode('/', $url);

               
        $url = parse_url($url);
        $params = explode('/', $url['path']);
        $request->controller = $params[1];
        $request->action = isset($params[2]) ? $params[2] : 'index';
        $request->params = array_slice($params, 3);
        return true;
    }

    /**
     * Connecte les routes à leur réelle action
     * Récupère l'URL envoyée (=href)
     * Remplace les paramètres de la route entrant
     * Remplacement par les valeurs des variables puis formattage de l'url réelle
     * 
     * @param String $redir l'url envoyée
     * @param String $url   l'url a connecter
     */
    static function connect($redir, $url) {
        //debug($redir);
        $r = array();
        $r['url']=$url;
        $r['params'] = array();
        $r['redir'] = $redir;
        //$r['origin']=  str_replace(':action', '(?<action>([a-z0-9]+))',$url);
        $r['origin'] = preg_replace('/([a-z0-9]+):([^\/]+)/', '${1}:(?P<${1}>${2})', $url);

        $r['origin'] = '/' . str_replace('/', '\/', $r['origin']) . '/';

        $params = explode('/', $url);
        foreach ($params as $k => $v) {
            if (strpos($v, ':')) {
                $p = explode(':', $v);
                $r['params'][$p[0]] = $p[1];
            } else {
                if ($k == 0) {
                    $r['controller'] = $v;
                } elseif ($k == 1) {
                    $r['action'] = $v;
                }
            }
        }
        $r['catcher'] = $redir;
        foreach ($r['params'] as $k => $v) {
            $r['catcher'] = str_replace(":$k", "(?P<$k>$v)", $r['catcher']);
        }
        $r['catcher'] = '/' . str_replace('/', '\/', $r['catcher']) . '/';

        
        self::$routes[] = $r;
        //debug($r);
    }

    /**
     * 
     * @param String $url
     * @return String   l'url reformatée
     */
    static function url($url){
        //debug(self::$routes);
        foreach (self::$routes as $v) {
            if(preg_match($v['origin'], $url, $matches)){
                foreach ($matches as $k => $w) {
                    if(!is_numeric($k)){
                        $v['redir']=  str_replace(":$k", $w, $v['redir']);
                       
                    }
                }
                return str_replace('//', '/','/'. $v['redir']);
            }
        }
        
        return $url;
    }


}




?>