<?
namespace Models;
use Helpers\Http as Http;
Class Categories{

	public function __construct(){

	}

	public function getCategories(){
		$categories = Http::get_web_page('https://api.epttavm.com/category/main/');
		$categoryData = json_decode($categories);

		if($categoryData->success == false){
			Http::response($categoryData);
		}
		return $categoryData->data;
	}
}
?>