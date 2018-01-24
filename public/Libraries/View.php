<?
namespace Libraries;

Class View{

	protected static $folder = "Views";

	public static  function render($name, $data=array(), $layout = true){
		extract($data);
		require_once(self::$folder.'/Header.php');

		if($layout)
		require_once(self::$folder.'/Navbar.php');

		if(file_exists(self::$folder.'/'.ucfirst($name).'.php')){
		  	require_once(self::$folder.'/'.ucfirst($name).'.php');
		}

		require_once(self::$folder.'/Footer.php');


	}
}
?>