<?php
if(Session::get('not-login') != null) {
  echo 'error bro';
  Session::del('not-login');
  exit;
}

?>

<html>
<head>
	<title>Dashboard Customer Service</title>
	<link rel="stylesheet" type="text/css" href="<?=URL?>resources/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="<?=URL?>resources/css/bootstrap-theme.css">
	<link rel="stylesheet" type="text/css" href="<?=URL?>resources/css/custom.css">
	<?php
  if(isset($this->css)) {
    foreach ($this->css as $css) {
      echo '<link rel="stylesheet" type="text/css" href="'. URL .'views/'. $css .'">';
    }
  }
  ?>
  <script type="text/javascript" src="<?=URL?>resources/js/jquery.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <script type="text/javascript" src="<?=URL?>resources/js/bootstrap.js"></script>
  <script type="text/javascript" src="<?=URL?>resources/js/jquery-rotate.js"></script>
	<script type="text/javascript" src="<?=URL?>resources/js/custom.js"></script>

  <?php
  if(isset($this->js)) {
    foreach ($this->js as $js) {
      echo '<script type="text/javascript" src="'.URL.'views/'. $js .'"></script>';
    }
  }
  ?>
  <script type="text/javascript" src="<?=URL?>resources/js/tinymce/tinymce.min.js"></script>
</head>
<body>
<!-- HEADER -->
<header class="navbar navbar-inverse" role="navigation">
  <div class="container">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="<?=URL?>">DASHBOARD</a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
      <li class=""><a href="<?=URL.'email'?>">Email</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Invoice <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="<?=URL.'invoice'?>">List</a></li>
          <li class="divider"></li>
          <li><a href="<?=URL.'invoice/create'?>">Create</a></li>
        </ul>
      </li>
      <li class=""><a href="<?=URL.'order'?>">Order</a></li>
      <!-- <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">Action</a></li>
          <li><a href="#">Another action</a></li>
          <li><a href="#">Something else here</a></li>
          <li class="divider"></li>
          <li><a href="#">Separated link</a></li>
          <li class="divider"></li>
          <li><a href="#">One more separated link</a></li>
        </ul>
      </li> -->
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <!-- # -->
      <?php
      if(Session::get('login-dashboard') == 1 or Cookie::get('login-dashboard') == 1) {
      ?>
      <li><a href="<?=URL.'dashboard/settings'?>">Settings</a></li>
      <?php }

      if(Session::get('login-dashboard') != null or Cookie::get('login-dashboard') != null) {
        $u = Session::get('sess-name');
        if ($u) {
          echo '<li class="active" style="text-transform:capitalize;"><a href="#">'.$u.'</a></li>';
        }
      }
      ?>

      <li class="active"></li>
      <li><a href="<?=URL.'dashboard/logout'?>">Logout</a></li>
    </ul>
  </div>
  <!-- /.navbar-collapse -->
  </div>
</header>
<!-- /HEADER -->

<content>
	<div class="container">
		<!-- CONTENT -->
    <?php
    // echo "<pre>";
    // print_r($_SESSION);
    // print_r($_COOKIE);
    // echo "</pre>";
    ?>
