<?php 

/**
* 
*/
class mail extends Controller
{	

	function __construct()
	{
		parent::__construct();
		$this->auth();
	}

	function index() {
		Redirect::to(URL);
	}

	function dum() {
		$this->view->render('mail/dum');
	}

	function load($id) {
		$show = $this->db->execute('select e.email, e.password, h.host from db_email e, db_host h where e.id_host = h.id_host AND e.id_email = '.$id);
		$this->view->connection = null;
		if($this->checkConnection()) {
			//connection email
			$this->view->mail = new receiveMail($show[0]['email'], $show[0]['password'], $show[0]['host']);
		} else {
			$this->view->connection = 0;
		}
		$this->view->render('mail/list');	
	}

	function delete($uid) {
		$this->view->msg = 'delete '. $uid;
		$this->index();
	}

	function read($id, $uid) {

		$this->view->msg = receiveMail::getBody($uid);
		$this->view->render('read/index', true);
	}

	function send() {
		$this->view->render('mail/send');
	}

}
?>