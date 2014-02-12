<!-- <div class="alert alert-danger no-radius">
	No internet connection could be made.
</div>
<div class="alert alert-success no-radius">
	Internet connection could be made.
</div> -->

<!-- <div class="menu-email">
	<button type="button" class="btn btn-default btn-sm">Search</button>
	<button type="button" class="btn btn-info btn-sm" data-toggle="button">Single toggle</button>
</div> -->
<div class="well well-sm no-radius">
	<div class="col-md-2">
		<select name="host" class="form-control input-sm" data-toggle="tooltip" data-placement="top" title="Host">
			<option value='0'>-- Host --</option>
			<?php
			$host = Database::executeS('SELECT * FROM db_host');
			foreach ($host as $key) {
				$_ = empty($key['hostname']) ? $key['host'] : $key['hostname'];
				echo '
				<option value="'.$key['id_host'].'">'.$_.'</option>
				';
			}
			?>
		</select>
	</div>
	<div class="clear"></div>
</div>
<?php

$paging = new Paging;

$paging->name('mail-list');
$paging->set('db_email', 6);
$paging->join('db_host','db_host.id_host = db_email.id_host');
$paging->limit();

echo '<div class="list-email">';
	foreach ($paging->create() as $show) {
		echo '
			<div class="col-sm-4">
				<div class="content-1"><img id="loading-'.$show['id_email'].'" class="loading loading-sm" src="'.IMG_DIR.'loading.png"></div>
				<div class="content-2"><a href="'.URL.'mail/load/'.$show['id_email'].'" class="load-link" data="'.$show['id_email'].'"><img src="'.IMG_DIR.'/new.png">'.$show['email'].'</a></div>
				<div class="content-3">'. $show['hostname'] .'</div>
			</div>
		';
	}
echo '</div>';

$paging->show();

?>
<script type="text/javascript">
$('[data-toggle="tooltip"]').tooltip();
</script>
<script type="text/javascript" src="<?=URL?>resources/js/rotate.js"></script>