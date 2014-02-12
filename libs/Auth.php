<?php 

class Auth
{
	
	function __construct()
	{
		echo 'asdasdas';
		$this->_err();
	}

	public static function userAuth() {
		if(empty(Cookie::get('login-dashboard')) or empty(Session::get('login-dashboard'))) {
			//echo 'asdasdas';
			//exit;
			$this->_err();
		}
	}

	private function _a() {
		echo 'asad';
		exit;
	}

	function _err() {
		require URL.'controllers/error.php';
		$controller = new Error();
		$controller->page(404);
		exit;
	}
}
?>