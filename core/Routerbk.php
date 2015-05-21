<?php

/**
* 
*/
class Router 
{   
	


    /**
    * Enlève les éventuels espaces et les '/' eux extremités de l'url
    * params[0]     '/'      controller  
    * params[0]     '/'      action
    * etc.
    * @param String $url No comment
    * @param Request $request controller/action/
    * @return bool
    **/
    static function parse($url, $request){
        $url=  parse_url($url);
        var_dump($url);
//$url=trim($url,'/');
        $params=explode('/', $url);

        $request->controller = $params[0];

        $request->action = isset($params[1]) ? $params[1] : 'index';
        $request->params=array_slice($params, 2);

        return true;
    }


}




?>