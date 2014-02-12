<?php 

/**
* 
*/
class dashboard extends Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->view->js = array('dashboard/js/js.js');
	}

	public function index() {
		Redirect::to(URL);
	}

	public function login() {
		$user = mysql_real_escape_string($_POST['user']);
		$pass = mysql_real_escape_string($_POST['pass']);

		$sql = $this->db->execute("select * from db_employee where username = \"$user\" and password = \"$pass\" and active = 1");
		if(count($sql)) {
			if(isset($_POST['remember'])) {
				Cookie::set('login-dashboard', $sql[0]['id_employee'], 48);
			} else {
				Session::set('login-dashboard', $sql[0]['id_employee']);
			}
			Session::set('sess-name', $sql[0]['username']);
			Redirect::to(URL);
		} else {
			$this->view->error = "Your username or password is wrong";
			$this->view->render('dashboard/login', true);
		}
	}

	public function logout() {
		Session::destroy();
		Cookie::del('login-dashboard');
		Redirect::to(URL);
	}

	public function settings($id = 1) {
		$this->_auth();

		Session::set('current-setting', $id);

		$this->view->render('dashboard/settings');
	}

	private function _auth() {
		if(Cookie::get('login-dashboard') == null and Session::get('login-dashboard') == null) {
			Redirect::to(URL);
		}
	}
}

?>