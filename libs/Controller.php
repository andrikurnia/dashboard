<?php 

/**
* CONTROLLER CORE
*/
class Controller
{

	
	function __construct()
	{
		$this->view = new View();
		$this->db = new Database();
		Session::init();
	}

	public function checkConnection() {
		//$con = @fsockopen('www.google.com',80, $errno, $errstr, 5);
		$con = 1;
		if($con) {
			$status = true;
			//fclose($con);
		} else {
			$status = false;
		}

		return $status;
	}

	public function loadMail($user, $pass, $host) {
		$this->mail = new receiveMail($user, $pass, $host);
	}

	public function auth() {
		if(Cookie::get('login-dashboard') == null) {
			if(Session::get('login-dashboard') == null) {
				Session::set('not-login', true);
				Redirect::to(URL);
			}
		}
	}

}
?>