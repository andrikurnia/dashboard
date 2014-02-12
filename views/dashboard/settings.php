<div class="row">
	<div class="col-sm-3">
		<div class="list-group">
		  <a href="<?=URL_DS?>/1" class="list-group-item pointer">Email Dashboard</a>
		  <a href="<?=URL_DS?>/2" class="list-group-item pointer">Website Order</a>
		  <a href="<?=URL_DS?>/3" class="list-group-item pointer">Host</a>
		  <a href="<?=URL_DS?>/4" class="list-group-item pointer">Customer Service</a>
		</div>
	</div>

	<div class="col-sm-9" id="settings-content">
	<?php
	$paging = new Paging;

	$page = Session::get('current-setting');
	/**
	*	1 = EMAIL
	*	2 = ORDER
	*	3 = HOST
	*	4 = CS
	**/
	switch ($page) {
		case '1': ?>
			<div id="email-dashboard" class="block">
				<div class="menu">
					<button class="btn btn-primary btn-sm no-radius" data-toggle="modal" data-target="#add">Tambah Email</button>
					<button class="btn btn-danger btn-sm no-radius" id="cancel" style="display:none;">Cancel</button>
				</div>

				<div id="edit">
				<?php
				$id = isset($_POST['edit-id']) ? $_POST['edit-id'] : null;
				if (isset($id)) {
					$edit = Database::executeS('SELECT * FROM db_email WHERE id_email = "'.$id.'"');
					?>
						<form role="form" class="form-horizontal" method="post" action="<?=URL.'process/editEmail/'.$id;?>">
						    <div class="modal-body">
						    	<div class="form-group">
						      		<label class="col-sm-2 control-label">E-mail</label>
						      		<div class="col-sm-10">
						      			<input type="email" name="email" class="form-control input-sm" value="<?=$edit[0]['email']?>">
						      		</div>
						      	</div>
						      	<div class="form-group">
						      		<label class="col-sm-2 control-label">Password</label>
						      		<div class="col-sm-10">
						      			<input type="password" name="pass" class="form-control input-sm" value="<?=$edit[0]['password']?>">
						      		</div>
						      	</div>
						      	<div class="form-group">
						      		<label class="col-sm-2 control-label">Host</label>
						      		<div class="col-sm-10">
						      			<select name="host" class="form-control input-sm">
						      				<?php
						      				$data = Database::executeS('select * from db_host');
						      				foreach ($data as $key) {
						      					$selected = "";
						      					if($key['id_host'] == $edit[0]['id_host']) $selected = "selected";
						      					
						      					echo '<option value="'. $key['id_host'] .'" '.$selected.'>'. $key['host'] .'</option>';
						      				}
						      				?>
						      			</select>
						      		</div>
						      	</div>
						    </div>
						    <div class="modal-footer">
						      <button type="submit" class="btn btn-warning btn-sm">Edit</button>
						    </div>
					    </form>
				<?php }	?>
				</div>
				<?php
				$paging->name('email');
				$paging->set('db_email');
				$paging->join('db_host', 'db_host.id_host = db_email.id_host');
				$paging->limit();
				?>
				<table width="100%" class="table table-striped table-list">
			  	  <tr>
			  	  	<th width="10px"><input type="checkbox" id="checkall"></th>
			  	  	<th width="50px">ID</th>
			 	  	<th width="250px">E-mail</th> 
			  	  	<th>Host</th>
			  	  	<th colspan="2" width="100px">Action</th>
			  	  </tr>
			  	  <?php
			  	  foreach ($paging->create() as $show) {
			  	  	echo '
			  	  	<tr>
			  	  		<td><input type="checkbox" name="checkemail"></td>
			  	  		<td>'. $show['id_email'] .'</td>
			  	  		<td>'. $show['email'] .'</td>
			  	  		<td>'. $show['host'] .'</td>
			  	  		<td width="50px">
			  	  				<span class="glyphicon glyphicon-edit pointer" data-id="'.$show['id_email'].'"></span>
			  	  		</td>
			  	  		<td width="50px">
			  	  			<a href="'.URL.'process/del/email/id_email/'.$show['id_email'].'" style="color:#FF4136">
			  	  				<span class="glyphicon glyphicon-remove"></span>
			  	  			</a>
			  	  		</td>
			  	  	</tr>
			  	  	';
			  	  }
			  	  
			  	  ?>
			    </table>
			    <?php
			    $paging->show();
			    ?>
			</div>	

			<!-- ADD MODAL -->
			<div class="modal fade" id="add" tabindex="-1" role="dialog">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" id="myModalLabel">Tambah Email</h4>
			      </div>
			      <form role="form" class="form-horizontal" method="post" action="<?=URL.'process/addEmail'?>">
				      <div class="modal-body">
				      	<div class="form-group">
				      		<label class="col-sm-2 control-label">E-mail</label>
				      		<div class="col-sm-10">
				      			<input type="email" name="email" class="form-control input-sm">
				      		</div>
				      	</div>
				      	<div class="form-group">
				      		<label class="col-sm-2 control-label">Password</label>
				      		<div class="col-sm-10">
				      			<input type="password" name="pass" class="form-control input-sm">
				      		</div>
				      	</div>
				      	<div class="form-group">
				      		<label class="col-sm-2 control-label">Host</label>
				      		<div class="col-sm-10">
				      			<select name="host" class="form-control input-sm">
				      				<?php
				      				$data = Database::executeS('select * from db_host');
				      				foreach ($data as $key) {
				      					echo '<option value="'. $key['id_host'] .'">'. $key['host'] .'</option>';
				      				}
				      				?>
				      			</select>
				      		</div>
				      	</div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				        <button type="submit" class="btn btn-primary">Submit</button>
				      </div>
			      </form>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

			
			<?php break;
		case '2': ?>
			<div id="order-setting" class="block">
				<div class="menu">
					<button class="btn btn-primary btn-sm no-radius" data-toggle="modal" data-target="#add">Tambah Website</button>
				</div>
				<?php
				$paging->name('web');
				$paging->set('db_website');
				$paging->join('db_cms','db_website.id_cms = db_cms.id_cms');
				$paging->limit();
				?>
				<table class="table table-striped">
					<tr>
						<th width="35%">Website</th>
						<th width="25%">CMS</th>
						<th width="20%">Server DB</th>
						<th width="20%">Nama DB</th>
					</tr>
					<?php
					foreach ($paging->create() as $key) {
					echo '
					<tr>
						<td>'.$key['web'].'</td>
						<td>'.$key['cms'].'</td>
						<td>'.$key['server_db'].'</td>
						<td>'.$key['db_name'].'</td>
					</tr>
					';
					}
					?>
				</table>
				<?=$paging->show();?>
			</div>

			<!-- ADD MODAL -->
			<div class="modal fade" id="add" tabindex="-1" role="dialog">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" id="myModalLabel">Tambah Website</h4>
			      </div>
			      <form role="form" class="form-horizontal" method="post" action="<?=URL.'process/addWeb'?>">
				      <div class="modal-body">
				      	<div class="form-group">
				      		<label class="col-sm-2 control-label">Website</label>
				      		<div class="col-sm-10">
				      			<input type="text" name="web" class="form-control input-sm">
				      		</div>
				      	</div>
				      	<div class="form-group">
				      		<label class="col-sm-2 control-label">Server Database</label>
				      		<div class="col-sm-10">
				      			<input type="text" name="server" class="form-control input-sm">
				      		</div>
				      	</div>
				      	<div class="form-group">
				      		<label class="col-sm-2 control-label">Username</label>
				      		<div class="col-sm-10">
				      			<input type="text" name="username" class="form-control input-sm">
				      		</div>
				      	</div>
				      	<div class="form-group">
				      		<label class="col-sm-2 control-label">Password</label>
				      		<div class="col-sm-10">
				      			<input type="password" name="password" class="form-control input-sm">
				      		</div>
				      	</div>
				      	<div class="form-group">
				      		<label class="col-sm-2 control-label">Database Name</label>
				      		<div class="col-sm-10">
				      			<input type="text" name="db" class="form-control input-sm">
				      		</div>
				      	</div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				        <button type="submit" class="btn btn-primary">Submit</button>
				      </div>
			      </form>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

			<?php break;
		case '3': ?>
			<div id="cs-setting" class="block">
				<div class="menu">
					<button class="btn btn-primary btn-sm no-radius" data-toggle="modal" data-target="#add">Tambah Host</button>
					<button class="btn btn-warning btn-sm no-radius" id="cancel" style="display:none;">Cancel</button>
				</div>

				<div id="edit"></div>
				<?php
				$paging->name('host');
				$paging->set('db_host');
				$paging->limit();
				?>
				<table width="100%" class="table table-striped table-list">
			  	  <tr>
			  	  	<th width="10px"><input type="checkbox" id="checkall"></th>
			  	  	<th width="50px">ID</th>
			 	  	<th width="200px">Hostname</th>
			  	  	<th>Host</th>
			  	  	<th colspan="2" width="100px">Action</th>
			  	  </tr>
			  	  <?php
			  	  foreach ($paging->create() as $show) {
			  	  	echo '
				  	  <tr>
				  	  	<td><input type="checkbox" name="check[]""></td>
				  	  	<td>'.$show['id_host'].'</td>
				  	  	<td>'.$show['hostname'].'</td>
				  	  	<td>'.$show['host'].'</td>
				  	  	<td width="50px">
				  	  		<span class="glyphicon glyphicon-edit pointer" data-id="'.$show['id_host'].'"></span>
				  	  	</td>
				  	  	<td width="50px">
				  	  		<a href="'.URL.'process/del/host/id_host/'.$show['id_host'].'" style="color:#FF4136">
				  	  			<span class="glyphicon glyphicon-remove"></span>
				  	  		</a>
				  	  	</td>
				  	  </tr>	
			  	  	';
			  	  }
			  	  ?>
			  	</table>
			  	<?=$paging->show();?>
			</div>
			<?php break;
		case '4':
		    if(Session::get('conflict-username') != null) {
		        echo '<div class="alert alert-danger no-radius">
                	Username <b>'.Session::get('conflict-username').'</b> already in use 
                </div>';
		    }
			?>
			<div id="cs-setting" class="block">
				<div class="menu">
					<button class="btn btn-primary btn-sm no-radius" data-toggle="modal" data-target="#add">Tambah Customer Service</button>
					<button class="btn btn-danger btn-sm no-radius" id="cancel" style="display:none;">Cancel</button>
				</div>

				<div id="edit">
				<?php
				$id = isset($_POST['edit-id']) ? $_POST['edit-id'] : null;
				if (isset($id)) {
					$edit = Database::executeS('SELECT * FROM db_employee WHERE id_employee = "'.$id.'"');
					?>
						<form role="form" class="form-horizontal" method="post" action="<?=URL.'process/editCs/'.$id;?>">
						    <div class="modal-body">
						    	<div class="form-group">
						      		<label class="col-sm-2 control-label">Customer Service</label>
						      		<div class="col-sm-10">
						      			<input type="text" name="text" class="form-control input-sm" value="<?=$edit[0]['username']?>">
						      		</div>
						      	</div>
						      	<div class="form-group">
						      		<label class="col-sm-2 control-label">Password</label>
						      		<div class="col-sm-10">
						      			<input type="password" name="pass" class="form-control input-sm" value="<?=$edit[0]['password']?>">
						      		</div>
						      	</div>
						    </div>
						    <div class="modal-footer">
						      <button type="submit" class="btn btn-warning btn-sm">Edit</button>
						    </div>
					    </form>
				<?php }	?>
				</div>
				<?php
				$paging->name('employee');
				$paging->set('db_employee WHERE id_type = 2');
				$paging->limit();
				?>
				<table width="100%" class="table table-striped table-list">
			  	  <tr>
			  	  	<th width="10px"><input type="checkbox" id="checkall"></th>
			  	  	<th width="50px">ID</th>
			 	  	<th>Customer Service</th>
			  	  	<th width="">Status</th>
			  	  	<th colspan="2" width="100px">Action</th>
			  	  </tr>
			  	  <?php
			  	  if($paging->create()) {
				  	  foreach ($paging->create() as $key) {
				  	  	$s = ($key['active']==0) ? 'inactive' : 'active';
				  	  	echo '
						<tr>
					  	  	<td><input type="checkbox" name="check[]"></td>
					  	  	<td>'.$key['id_employee'].'</td>
					  	  	<td>'.$key['username'].'</td>
					  	  	<td><span class="pointer status '.$s.'" data-user="'.$key['id_employee'].'" data-status="'.$key['active'].'">'.$s.'</span></td>
					  	  	<td width="50px">
					  	  		<span class="glyphicon glyphicon-edit pointer" data-id="'.$key['id_employee'].'"></span>
					  	  	</td>
					  	  	<td width="50px">
					  	  		<a href="'.URL.'process/del/employee/id_employee/'.$key['id_employee'].'" style="color:#FF4136">
					  	  			<span class="glyphicon glyphicon-remove"></span>
					  	  		</a>
					  	  	</td>
				  	  	</tr>
				  	  	';
				  	  }
			  	  }
			  	  ?>
			  	</table>
			  	<?=$paging->show();?>
			</div>
			
			<!-- ADD MODAL -->
			<div class="modal fade" id="add" tabindex="-1" role="dialog">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" id="myModalLabel">Tambah Customer Service</h4>
			      </div>
			      <form role="form" class="form-horizontal" method="post" action="<?=URL.'process/addCs'?>" enctype="multipart/form-data">
				      <div class="modal-body">
				      	<div class="form-group">
				      		<label class="col-sm-3 control-label">Customer Service</label>
				      		<div class="col-sm-9">
				      			<input type="text" name="cs" class="form-control input-sm">
				      		</div>
				      	</div>
				      	<div class="form-group">
				      		<label class="col-sm-3 control-label">Password</label>
				      		<div class="col-sm-9">
				      			<input type="password" name="pass" class="form-control input-sm">
				      		</div>
				      	</div>
				      	<div class="form-group">
				      		<label class="col-sm-3 control-label">Confirm Password</label>
				      		<div class="col-sm-9">
				      			<input type="password" id="checkpass" class="form-control input-sm">
				      		</div>
				      	</div>
				      	<div class="form-group">
				      		<label class="col-sm-3 control-label">Photo</label>
				      		<div class="col-sm-9">
				      			<input type="file" class="form-control input-sm" name="photo">
				      		</div>
				      	</div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				        <button type="submit" class="btn btn-primary">Submit</button>
				      </div>
			      </form>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

			<script type="text/javascript">
			$(document).ready(function() {
				$('.status').click(function() {
					var st = $(this).attr('data-status');
					var u = $(this).attr('data-user');
					$.ajax({
						url : '<?=URL?>process/stat/'+st+'',
						type : 'POST',
						data : {'id': ''+ u +''},
						success: function(data) {
							location.reload();
						}
					});
				});

				$('#checkpass').change(function() {
					var a = $('[name="pass"]').val();
					var b = $(this).val();
					if(a === b) {
						$('[name="pass"]').parent().addClass('has-success').removeClass('has-error');
						$(this).parent().addClass('has-success').removeClass('has-error');
					} else {
						$('[name="pass"]').parent().addClass('has-error').removeClass('has-success');
						$(this).parent().addClass('has-error').removeClass('has-success');
					}
				});

			});
			</script>
			<?php break;

		default:
			# code...
			break;
	}
	?>
	</div>
</div>