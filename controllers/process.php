<?php

/**
* 
*/
class process extends Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function sendEmail() {

	}

	// PROCESS DASHBOARD SETTINGS
	function addEmail() {
		Database::executeS('INSERT INTO db_email values(null, "'.$_POST['email'].'","'.$_POST['pass'].'","'.$_POST['host'].'")');
		Redirect::to($_SERVER['HTTP_REFERER']);
	}

	function editEmail($id) {
		Database::executeS('UPDATE db_email SET
			email = "'. $_POST['email'] .'",
			password = "'. $_POST['pass'] .'",
			id_host = "'. $_POST['host'] .'"
			WHERE id_email = "'. $id .'"
		');
		Redirect::to($_SERVER['HTTP_REFERER']);
	}

	function addCs() {
		$foto = $_FILES['photo']['name'];
		$tmp = $_FILES['photo']['tmp_name'];
		$rm = explode('.', $foto);
		$rm = $rm[(count($rm)-1)];
		$rm = rand(0,9999).'_'.rand(0,9999).'.'.$rm;
		// echo $tmp.'<br>';
		// echo is_dir('config').'<br>';
		// echo is_uploaded_file($tmp);
		
		# Check Username
		$user = Database::executeS('SELECT * FROM db_employee WHERE username = "'.$_POST['cs'].'"');
		if(count($user)) {
		    Session::set('conflict-username', $_POST['cs']);
		} else {
		    Database::executeS('INSERT INTO db_employee values(null, "'.$_POST['cs'].'","'.$_POST['pass'].'","'.$rm.'","2","0")');
		    move_uploaded_file($tmp, IMG_DIR.'users/'.$rm);
	    }
		Redirect::to($_SERVER['HTTP_REFERER']);
	}

	function stat($id) {
		$id = !$id;
		Database::executeS('UPDATE db_employee SET active = "'.$id.'" WHERE id_employee = "'.$_POST['id'].'"');
	}

	function addWeb() {
		Database::executeS('INSERT INTO db_website values(null,
			"'. $_POST['web'] .'","1",
			"'. $_POST['server'] .'",
			"'. $_POST['username'] .'",
			"'. $_POST['password'] .'",
			"'. $_POST['db'] .'")');
		Redirect::to($_SERVER['HTTP_REFERER']);
	}

	function del($type, $param, $id) {
		if($type == "employee") {
			$data = Database::executeS('SELECT foto FROM db_employee WHERE '.$param.' = "'.$id.'"');
			unlink(IMG_DIR.'users/'.$data[0]['foto']);
		}
		Database::executeS('DELETE FROM db_'.$type.' WHERE '.$param.' = "'.$id.'"');
		Redirect::to($_SERVER['HTTP_REFERER']);
	}
}

?>