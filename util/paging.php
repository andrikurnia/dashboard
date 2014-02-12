<?php 

session_start();
$type = $_GET['t'];
$_SESSION['paging-'.$type] = $_GET['p'];
header("location:".$_SERVER['HTTP_REFERER']);
?>