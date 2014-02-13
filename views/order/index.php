<?php
echo $this->return;
?>
<?php
/*
Database::setDb('localhost','root','','ps_1531');
$data = Database::executeS('SELECT o.id_order, o.reference, c.firstname, c.lastname, c.id_gender, o.id_currency, o.total_paid 
	FROM ps_orders o INNER JOIN ps_customer c ON o.id_customer = c.id_customer ORDER BY o.id_order DESC');

?>
<h3>edu4indo</h3>
<table class="table table-striped table-hover" style="border: 1px solid #ccc">
	<tr>
		<th width="150px">ID Order</th>
		<th width="100px">Reference</th>
		<th width="40%">Customer</th>
		<th width="250px">Total</th>
		<th></th>
	</tr>

<?php
foreach ($data as $key) {
	$cur = ($key['id_currency'] == 1) ? '$' : 'Rp';
	$price = explode('.', $key['total_paid']);
	echo '
	<tr data-order="'. $key['id_order'] .'" class="data-order">
		<td>'. $key['id_order'] .'</td>
		<td>'. $key['reference'] .'</td>
		<td>'. $key['firstname'] .' '. $key['lastname'].'</td>
		<td>'.$cur.' '. $price[0] .'</td>
		<td>
			<a href="'.URL.'order/view/'. $key['id_order'] .'" style="color:#333">
			<span class="glyphicon glyphicon-file"></span>
			</a>
		</td>
	</tr>
	';
}
?>
</table>
*/
