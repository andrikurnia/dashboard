<?php

class email extends Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		$this->view->css = array('dashboard/css/style.css');
		$this->view->js = array('dashboard/js/js.js');
		$this->view->render('dashboard/index');
	}
}

?>