<?php


class Request{

	public $url;


	/**
	* Retranscrit l'URL sous forme de chaine
	* @param
	* @return
	**/
	function __construct(){

		$this->url = str_replace(BASE_URL."/", "", $_SERVER['REQUEST_URI']); 	
	}


}


?>