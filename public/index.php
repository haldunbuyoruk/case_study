<?
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once(__DIR__.'/autoload.php');
use \Configs\Config as Config;
new \Routes\Route();
?>