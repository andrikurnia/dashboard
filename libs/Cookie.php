<?php 

/**
* 
*/
class Cookie
{

	public static function set($name, $value, $hour = 1) {
		$min = $hour * 3600;
		setcookie($name, $value, time()+$min, '/');
	}

	public static function get($name) {
		if (isset($_COOKIE[$name]))
			return $_COOKIE[$name];
	}

	public static function del($name) {
		setcookie($name, '', time()-360000, '/');
	}
		
}

?>