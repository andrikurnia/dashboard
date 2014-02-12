<?php

class page extends Controller {

	function __construct() {
		parent::__construct();
	}

	function set($type, $page) {
		$name = 'paging-'. $type;
		$_SESSION['paging-'.$type] = $page;
		header("location:".$_SERVER['HTTP_REFERER']);
	}
}

?>