<?php
function __autoload($class)
{
	$fileRoot = '/src';
    $parts = explode('\\', $class);
    
    if(!empty($parts)){
    	foreach ($parts as $key => $value) {
    		if($key == 0)
    			$value = strtolower($value);
    		$fileRoot .= '/'.$value;
    	}
    }
    require_once __DIR__.$fileRoot . '.php';
}
use \Controllers\IndexController;
$controller = new IndexController();
$controller->getCategories();

?>