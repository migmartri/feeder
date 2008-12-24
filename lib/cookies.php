<?php
class Cookies {
  function createCookie($cookie_name, $cookie_value, $cookie_time) {
    setcookie($cookie_name, $cookie_value, $cookie_time);
	}
	
	function readCookie($cookie_name) {
    return $_COOKIE[$cookie_name];
	
	}
	
	function deleteCookie($cookie_name) {
    setcookie($cookie_name, "", time()-3600);
	}
}
?>
