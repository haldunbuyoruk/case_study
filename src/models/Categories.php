<?php
namespace Models;
use Helpers\Http as Http;
Class Categories{

	public function __construct(){

	}

	public function getCategories(){
		$headers = array('Accept: application/json','Content-Type: application/json','X-EPA-Request-Id:'.Http::generateRandomString());
		return Http::get_web_page('https://api.epttavm.com/category/main/',$headers);
	}
}
?>