<div class="block">
	<?php
	$data = Database::executeS('SELECT * FROM db_website WHERE id_web = "'.$this->db.'"');
	Database::setDb($data[0]['server_db'], $data[0]['username'], $data[0]['passwd'], $data[0]['db_name']);
	$val = is_numeric($this->id) ? $this->id : '';
	$sql = Database::executeS('SELECT od.product_id, od.product_name, od.product_price, od.product_quantity, o.id_currency
		FROM ps_order_detail od INNER JOIN ps_orders o ON o.id_order = od.id_order
		WHERE od.id_order = "'.$val.'"');
	$c = Database::executeS('SELECT c.firstname, c.lastname, c.email, o.date_add FROM ps_customer c INNER JOIN ps_orders o ON o.id_customer = c.id_customer WHERE o.id_order = "'.$val.'"');
	// echo '<pre>';
	// print_r($sql);
	// echo'</pre>';
	echo '
	<h3>'.$data[0]['web'].'</h3>
	<div class="navigation-order">
		<div class="id_order pull-left">ID ORDER : '. $val .'</div>
		<button class="btn btn-primary btn-sm pull-right no-radius">Buat Invoice</button>
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
		$cur = ($key['id_currency'] == 1) ? '$' : 'Rp';
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
	?>
</div>
