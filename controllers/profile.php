<?php
class profile extends Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {}

	function view($profile = 'default') {
		switch($profile) {
			case "default":
			default:
				$this->view->render('profile/default/index', true);
			break;
		}
	}
}

?>