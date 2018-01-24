<?php
namespace Helpers;
class Http {

    public static $requestDelay = 100;
    public static $lastRequestTime = 0;
    public static $requestCounter = 0;

    /**
     * [generateRandomString for EPTT Developer Evaluation]
     * @param  integer $length [description]
     * @return [type]          [description]
     */
    public static function generateRandomString($length = 10) {
    	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    	$charactersLength = strlen($characters);
    	$randomString = '';
    	list($usec, $sec) = explode(' ', microtime());
    	srand($sec + $usec * 1000000);
    	for ($i = 0; $i < $length; $i++) {
    	    $randomString .= $characters[rand(0, $charactersLength - 1)];
    	}
        return $randomString;
    }


    public static function get_web_page( $url,$post = false){
        $headers = array('Accept: application/json','Content-Type: application/json','X-EPA-Request-Id:'.self::generateRandomString());
        $options = array(
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER => $headers,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            #CURLOPT_USERAGENT      => "spider", // who am i
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_MAXREDIRS      => 1,       // stop after 10 redirects
            CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
        );

        $ch      = curl_init( $url );
        curl_setopt_array( $ch, $options );
        $content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );

        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['content'] = $content;
        return $header['content'];
    }

    public static function response($data){
        http_response_code($data->err_code);
        echo $data->err_msg;
        die;
    }
}

?>
