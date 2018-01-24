<?php
namespace Controllers;
use \Models\Categories as Categories;
Class IndexController{

	public function getCategories(){
		$categories = new Categories();
		var_dump($categories->getCategories());
	}
}
?>