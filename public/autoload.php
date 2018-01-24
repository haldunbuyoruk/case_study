<? 
function __autoload($class){
	$fileRoot = '';
    $parts = explode('\\', $class);
    if(!empty($parts)){
    	foreach ($parts as $key => $value) {
    		if($key == 0)
    			$value = ucfirst($value);
    		$fileRoot .= '/'.$value;
    	}
    }
    require_once __DIR__.$fileRoot . '.php';
}
?>