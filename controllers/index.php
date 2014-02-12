<?php 

/**
* 
*/
class Index extends Controller
{
	
	function __construct()
	{
		parent::__construct();
		require 'config/session.php';
	}

	function index() {
		if(Cookie::get('login-dashboard') != null or Session::get('login-dashboard') != null) {
	        $this->view->render('welcome');			
		} else {
			$this->view->render('dashboard/login', true);
	    }
    }
}
?>