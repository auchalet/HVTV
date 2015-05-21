<?php


class Request{

	public $url;
        public $page=1;


	/**
	* Retranscrit l'URL sous forme de chaine
	* @param
	* @return
	**/
	function __construct() {

        $this->url = str_replace(BASE_URL."/","", $_SERVER['REQUEST_URI']);
        //$this->url = isset($_SERVER['PATH_INFO'] ) ? $_SERVER['PATH_INFO'] : '/' ;    
        if (isset($_GET['page'])) {
            if (is_numeric($_GET['page'])) {
                if ($_GET['page'] > 0) {
                    $this->page = round($_GET['page']);
                }
            }
        }
       // var_dump($this);
    }

}


?>