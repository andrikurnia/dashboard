<?php

$config['session'] = array(
	'paging-email',
	'paging-employee',
	'paging-host',
	'paging-web',
	'paging-mail-list'
);

foreach ($config['session'] as $key) {
	if(empty($_SESSION[$key]))
		$_SESSION[$key] = 1;
}

?>