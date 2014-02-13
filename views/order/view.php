<div class="notification">
</div>
<div class="block">
	<?php
	$result = null;
	$data = Database::executeS('SELECT * FROM db_website WHERE id_web = "'.$this->db.'"');
	Database::setDb($data[0]['server_db'], $data[0]['username'], $data[0]['passwd'], $data[0]['db_name']);
	$val = is_numeric($this->id) ? $this->id : '';
	$sql = Database::executeS('SELECT od.product_id, od.product_name, od.product_price, od.product_quantity, c.sign
		FROM ps_order_detail od 
		INNER JOIN ps_orders o ON o.id_order = od.id_order 
		LEFT JOIN ps_currency c ON c.id_currency = o.id_currency 
		WHERE od.id_order = "'.$val.'"');
	$c = Database::executeS('SELECT c.firstname, c.lastname, c.email, o.date_add FROM ps_customer c INNER JOIN ps_orders o ON o.id_customer = c.id_customer WHERE o.id_order = "'.$val.'"');
	// echo '<pre>';
	// print_r($sql);
	// echo'</pre>';
	echo '
	<h3>'.$data[0]['web'].'</h3>
	<div class="navigation-order">
		<div class="id_order pull-left">ID ORDER : '. $val .'</div>
		<button class="btn btn-primary btn-sm pull-right no-radius" id="create-invoice">Buat Invoice</button>
		<select name="status" class="form-control input-sm pull-right" style="width:auto;margin-right:20px;">
			<option value="0" selected>Belum Lunas</option>
			<option value="1">Lunas</option>
		</select>
		<div class="clear"></div>
	</div>';

	echo '
	<div class="detail-customer">
	<span class="col-md-2">Customer Name</span>: '.$c[0]['firstname'].' '.$c[0]['lastname'].'<br>
	<span class="col-md-2">E-mail</span>: '.$c[0]['email'].'<br>
	<span class="col-md-2">Order date</span>: '.$c[0]['date_add'].'
	</div>
	';

	echo '<table class="table table-striped">
			<tr>
				<th width="100px">ID</th>
				<th width="50%">Product Name</th>
				<th width="150px">Unit Price</th>
				<th width="100px">Qty</th>
				<th>Total</th>
			</tr>';
	$data['subtotal'] = null;
	$i = 0;

	foreach ($sql as $key) {
		$price = explode('.', $key['product_price']);
		$cur = str_replace('?', ' ', $key['sign']);
		echo '
		<tr>
			<td>'. $key['product_id'] .'</td>
			<td>'. $key['product_name'] .'</td>
			<td>'. $cur .' '. $price[0] .'</td>
			<td>'. $key['product_quantity'] .'</td>
			<td>'. $cur .' '. $key['product_quantity']*$price[0] .'</td>
		</tr>
		';
		$data['cur'] = $cur;
		$data['subtotal'][$i] = $key['product_quantity']*$price[0];
		$result['barang'][$i] = array('id' => $key['product_id'],
							'barang' => substr(utf8_encode($key['product_name']), 0, 35),
							'cur' => $cur,
							'harga' => $price[0],
							'qty' => $key['product_quantity'],
							'total' => $key['product_quantity']*$price[0]);
		$i++;
	}
	echo '
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<th>Subtotal</th>
		<td>'.$data['cur'].' '.array_sum($data['subtotal']).'</td>
	</tr>';
	echo "</table>";
	$result['id_website'] = $data[0]['id_web'];
	$result['website'] = $data[0]['web'];
	$result['id_order'] = $val;
	$result['customer'] = array(
		'fn'	=> $c[0]['firstname'],
		'ln'	=> $c[0]['lastname'],
		'email'	=> $c[0]['email']);
	$result['subtotal'] = array_sum($data['subtotal']);
	?>
</div>
<?php
echo '<pre>';
print_r($result);
$a = json_encode($result);
echo($a);
?>
<script type="text/javascript">
$(document).ready(function() {
	$('#create-invoice').click(function() {
		var val = '<?=json_encode($result)?>';
		var status = $('select[name="status"]').val();
		$.ajax({
			url	: "<?=URL?>invoice/create",
			type : "POST",
			data : {'data' : ''+val+'', 'status':''+status+''},
			success : function(e) {
				console.log(e);
				$(".notification").html("<div class='alert alert-success no-radius'>SUCCESS: Invoice has been made, you can see invoice <a href='<?=URL?>invoice/list'>here</a></div>");
			},
			error : function() {
				$(".notification").html("<div class='alert alert-danger no-radius'>ERROR: Sorry, Invoice couldn't creaated</div>");
			}
		});
	});
});
</script>
<!-- <div class="alert alert-danger no-radius">
	No internet connection could be made.
</div>
<div class="alert alert-success no-radius">
	Internet connection could be made.
</div> -->