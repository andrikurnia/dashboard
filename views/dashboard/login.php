<html>
<head>
	<title>Dashboard Login</title>
	<link rel="stylesheet" type="text/css" href="<?=URL?>resources/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?=URL?>resources/css/custom.css">
	<style type="text/css">
	
	</style>
</head>
<body>
<div class="container">
	<div id="title" class="col-md-offset-4 col-sm-4">
		<?php
		// echo "<pre>";
		// print_r($_SESSION);
		// print_r($_COOKIE);
		// echo "</pre>";
		?>
		<h3>Dashboard</h3>
	</div>
	<div id="login" class="col-md-offset-4 col-sm-4">
		<?php if(!empty($this->error)) { ?>
		<div class="alert alert-danger">
			<?=$this->error;?>
		</div>
		<?php } ?>
		<form action="<?=URL.'dashboard/login'?>" method="post" role="form">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Username" name="user">
			</div>
			<div class="form-group">
				<input type="password" class="form-control" placeholder="Password" name="pass">
			</div>
			<div class="form-group">
				<button class="btn btn-primary btn-sm">Login</button>
				<span class="checkbox">
					<label>
				    	<input type="checkbox" name="remember"> Remember me
				    </label>
				</span>
			</div>
		</form>
	</div>
</div>
</body>
</html>