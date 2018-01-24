<?php
namespace Libraries;
use Configs\Config as Config;
class DB {

	private static $link = NULL;

	static function connect(){
		if(!self::$link){
			self::$link = new \mysqli(
							Config::DB_HOST,
							Config::DB_USER,
							Config::DB_PASSWORD,
							Config::DB_NAME,
						    Config::DB_PORT);

			// Error handling
			if(mysqli_connect_error()) {
				trigger_error("Failed to conencto to MySQL: " . mysqli_connect_error(), E_USER_ERROR);
			}
			mysqli_set_charset(self::$link, Config::DB_CHARSET);
		}
	}


	static function getConnection() {
		return self::$link;
	}

	static function getInsertID() {
		if (!self::$link) {
		    self::connect();
		}
		return mysqli_insert_id(self::$link);
	}

	static function query($query) {
		if (!self::$link) {
		    self::connect();
		}
		return mysqli_query(self::$link, $query);
	}

    static function escape($str){
	    if(!$str){ return $str; }
	    if(!is_string($str)){ return $str; }

	    if(!self::$link){
	       self::connect();
	    }

	    return self::$link->real_escape_string($str);

    }
	// select * from a where b=:b , array ( ':b' => 'test', ':a' => 'fds' )
	static function parseQuery($args){
		$query = $args[0];
		foreach ($args as $key => $replaceVals) {
			if(is_array($replaceVals)){
				$query = str_replace(array_keys($replaceVals), self::escape(array_values($replaceVals)), $query);
			}
		}

		return $query;
	}

	static function read(){
		$args_arr = func_get_args();

		if(count($args_arr) > 1){
		   $query = self::parseQuery($args_arr);
		}else{
		    $query = $args_arr[0]; // full query without args
		}

		# If there's no connection, do a connection first.
		if($result = self::query($query)){
		    $data = array();
		    while($line = mysqli_fetch_object($result)){
		        array_push($data, $line);
		    }
		    if(is_resource($result)){
		        mysqli_free_result($result);
		    }

		}else{
		    return (object)array("success" => false, "error" => mysqli_error(self::$link), "query" => $query);
		}

		return (object)array("success" => true, "result" => $data, "query" => $query);
	}

	static function write(){

		$args_arr = func_get_args();

		if(count($args_arr) > 1){
		    $query = self::parseQuery($args_arr);
		}else{
		    $query = $args_arr[0]; // full query without args
		}

	    if($result = self::query($query)){
	        $response =  (object) array("success" => true, "rows" => mysqli_affected_rows(self::$link), "insert_id"=>self::getInsertID());
	    }else{
	        #$response = (object) array("success" => false, "error" => mysqli_error(self::$link), "query" => $query);
	        $response = (object) array("success" => false, "error" => mysqli_error(self::$link));
	    }
	    if(is_resource($result)){
	        mysqli_free_result($result);
	    }
	    return $response;
	}

	static function close() {
		mysqli_close(self::$link);
		self::$link = NULL;
	}
}
