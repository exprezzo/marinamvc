<?php
class JanRainUser extends UserController{
	var $rpx_api_key = 'da8a483a42817d06090161fb1903c0cce1088762';
	function JanRainLogin(){
		$rpx_api_key=$this->rpx_api_key;
		ob_start();
		$engage_pro = false;
		/* STEP 1: Extract token POST parameter */
		$token = $_POST['token'];
		//Some output to help debugging
		// echo "SERVER VARIABLES:\n";
		// var_dump($_SERVER);
		// echo "HTTP POST ARRAY:\n";
		// var_dump($_POST);
		if(strlen($token) !== 40) {
		  // Gracefully handle the missing or malformed token.  Hook this into your native error handling system.
		  echo 'Authentication canceled.';
		  exit;
		}
		/* STEP 2: Use the token to make the auth_info API call */
		$post_data = array('token'  => $token,
						 'apiKey' => $rpx_api_key,
						 'format' => 'json',
						 'extended' => 'true'); //Extended is not available to Basic.

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_URL, 'https://rpxnow.com/api/v2/auth_info');
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_FAILONERROR, true);
		$result = curl_exec($curl);
		if ($result == false){
			echo "\n".'Curl error: ' . curl_error($curl);
			echo "\n".'HTTP code: ' . curl_errno($curl);
			echo "\n"; var_dump($post_data);
			exit;
		}
		curl_close($curl);


		/* STEP 3: Parse the JSON auth_info response */
		$auth_info = json_decode($result, true);

		if ($auth_info['stat'] == 'ok') {
			echo "\n auth_info:";
			echo "\n"; var_dump($auth_info);
		}else {
			// Gracefully handle auth_info error.  Hook this into your native error handling system.
			echo "\n".'An error occured: ' . $auth_info['err']['msg']."\n";
			var_dump($auth_info);
			echo "\n";
			var_dump($result);
		}
		
	}		
}
/*
["profile"]=>
  array(11) {
    ["providerName"]=>
    string(8) "Facebook"
    ["identifier"]=>
    string(49) "http://www.facebook.com/profile.php?id=1283546927"
    ["verifiedEmail"]=>
    string(23) "runtim3.error@gmail.com"
    ["preferredUsername"]=>
    string(14) "CesarBibriesca"
    ["displayName"]=>
    string(15) "Cesar Bibriesca"
    ["name"]=>
    array(3) {
      ["formatted"]=>
      string(15) "Cesar Bibriesca"
      ["givenName"]=>
      string(5) "Cesar"
      ["familyName"]=>
      string(9) "Bibriesca"
    }
    ["email"]=>
    string(23) "runtim3.error@gmail.com"
    ["url"]=>
    string(39) "http://www.facebook.com/cesar.bibriesca"
    ["photo"]=>
    string(56) "https://graph.facebook.com/1283546927/picture?type=large"
    ["utcOffset"]=>
    string(6) "-07:00"
    ["gender"]=>
    string(4) "male"
  }
  ["limited_data"]=>
  string(5) "false"
*/
?>