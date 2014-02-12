<?php

class order extends Controller {

	function __construct() {
		parent::__construct();
		$this->auth();
	}

	function index() {
		$this->_listOrder();	
		$this->view->render('order/index');
	}

	function view($db, $id) {
		if(empty($id) || empty($db)) {
			Redirect::to(URL.'order');
		}
		$this->view->id = $id;
		$this->view->db = $db;
		$this->view->render('order/view');
	}

	private function _listOrder() {
		$this->view->return = null;
		$data = $this->_getWeb();
		foreach ($data as $key) {
			Database::setDb($key['server_db'], $key['username'], $key['passwd'], $key['db_name']);
			$sql = Database::executeS('SELECT o.id_order, o.reference, c.firstname, c.lastname, c.id_gender, o.id_currency, o.total_paid 
					FROM ps_orders o INNER JOIN ps_customer c ON o.id_customer = c.id_customer ORDER BY o.id_order DESC');
			
			$this->view->return .= '
			<h3>'.$key['web'].'</h3>
			<table class="table table-striped table-hover" style="border: 1px solid #ccc">
				<tr>
					<th width="150px">ID Order</th>
					<th width="100px">Reference</th>
					<th width="40%">Customer</th>
					<th width="250px">Total</th>
					<th>Action</th>
				</tr>
			';

			foreach ($sql as $val) {
				$cur = ($val['id_currency'] == 1) ? '$' : 'Rp';
				$price = explode('.', $val['total_paid']);
				$this->view->return .= '
				<tr data-order="'. $val['id_order'] .'" class="data-order">
					<td>'. $val['id_order'] .'</td>
					<td>'. $val['reference'] .'</td>
					<td>'. $val['firstname'] .' '. $val['lastname'].'</td>
					<td>'.$cur.' '. $price[0] .'</td>
					<td>
						<a href="'.URL.'order/view/'. $key['id_web'] .'/'. $val['id_order'] .'" style="color:#333">
						<span class="glyphicon glyphicon-file"></span>
						</a>
					</td>
				</tr>
				';
			}

			$this->view->return .= '</table>';
		}
	}

	private function _getWeb() {
		$data = Database::executeS('SELECT * FROM db_website w INNER JOIN db_cms c ON w.id_cms = c.id_cms');
		return $data;
	}
}

?>