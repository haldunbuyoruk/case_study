<?
namespace Controllers;
use \Models\Categories as Categories;

Class CategoriesController{

	public $categories;

	public function __construct(){
		$this->categories = new Categories();
	}

	public function getCategories(){
		$categoryData = $this->categories->getCategories();
		return $categoryData;
	}
}