<?php

class Invoice extends Controller
{
	function __construct() {
		parent::__construct();
		$this->auth();

		$this->view->css = array('invoice/css/style.css');
		$this->view->js = array('invoice/js/script.js');
	}

	function index() {
		$this->view->db = $this->db;

		$this->view->render('invoice/index');
	}

	function create() {
		$this->view->render('invoice/create');
	}
}

?>