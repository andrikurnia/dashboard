<?php
//print_r($this->a);
if(isset($this->connection)) {
	echo '
	<div class="alert alert-danger no-radius">
		No internet connection could be made.
	</div>
	';
	return false;
}
$this->mail->connect();

// $id = isset($_POST['uid']) ? $_POST['uid'] : null;
// if(!empty($id)) {
// 	echo '
// 	<div id="getmail">
// 	'. $this->mail->getBody($id) .'
// 	</div>
// 	';
// }
// echo "<pre>";
// print_r($this->mail->getHeader());
// echo "</pre>";
?>
<h3>cs@edu4indo.com</h3>
<div class="row" id="email-header">
	<div class="col-md-12">
		<div class="col-md-5" style="border:1px solid #eee">
			<h5>E-mail form</h5>
		</div>
		<div class="col-md-5" style="border:1px solid #eee">
			<h5>Subject</h5>
		</div>
		<div class="col-md-1" style="border:1px solid #eee">
			<h5>Date</h5>
		</div>
		<div class="col-md-1" style="border:1px solid #eee">
			<h5>Read</h5>
		</div>
	</div>
</div>
	<?php
	$val = 1;
	foreach ($this->mail->getHeader() as $key) {
	$style = ($val%2 == 0) ? "": "email-odd";
	echo '<div class="email-range '.$style.'">
			<div class="row" style="padding:5px 30px">
				<div class="col-md-5">
					'.$key['from'].' ('.$key['email'].')
				</div>
				<div class="col-md-5">
				'.$key['subject'].'
				</div>
				<div class="col-md-1">
				'.str_replace('-', '/', $key['date'][0]).'
				</div>
				<div class="col-md-1">
					<button class="btn btn-default btn-sm btn-block">
						<span class="glyphicon glyphicon-envelope"></span>
					</button>
				</div>
			</div>
			<div class="show-email">
				<div style="padding: 5px 30px">
					<div class="email-panel">
					Awawaw
					</div>
				</div>
			</div>
		</div>';
	$val++;
	}
	?>

<!-- <hr>
<div id="totalMail"></div>

<div class="row">
	<div class="col-sm-12">
		<div class="email-list">
		  <table width="100%" class="table table-striped table-hover" style="border: 1px solid #ccc">
		    <tr>
		    	<th width="220px">From</th>
		    	<th>Subject</th>
		    	<th width="90px">Date</th>
		    </tr>
		    <?php
		    // foreach ($this->mail->getHeader() as $show) {
		    // 	echo '
			   //  <tr data-value="'.$show['uid'].'" class="read-mail">
			   //  	<td width="220px">'. $show['from'] .'</td>
			   //  	<td>'. substr($show['subject'], 0, 30).'</td>
			   //  	<td width="120px">'. $show['date'][0] .'</td>
			   //  </tr>
			   //  <tr>
			   //  	<td>&nbsp;</td>
			   //  	<td colspan=2>
			   //  	Mail Content<hr>
			   //  	'. $this->mail->getBody($show['uid']) .'
			   //  	</td>
			   //  </tr>';
		    // }
		    ?>
		  </table>
		</div>
		<div class="block">

		</div>

		<script type="text/javascript">
		$(document).ready(function() {
			$('.read-mail').click(function() {
				var val = $(this).attr('data-value');
				$.ajax({
					type : "POST",
					data : {'uid':''+val+''},
					success : function(data) {
						console.log(data);
					}
				})
			});
		});
		</script>
	</div>
</div> -->