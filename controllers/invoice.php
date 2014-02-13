<?php

class Invoice extends Controller
{
	function __construct() {
		parent::__construct();
		$this->auth();

		$this->view->css = array('invoice/css/style.css');
		$this->view->js = array('invoice/js/script.js');
	}

	function index() {
		$this->view->db = $this->db;
		
		$dir = "resources/file/*";

		print_r(glob($dir.'{".pdf"}'), GLOB_BRACE);
		foreach (glob($dir) as $filename) {
		    $this->view->list[] = $filename;
		}
		
		$this->view->render('invoice/index');
	}
	
	function create() {
		if (file_exists(LIBS.'fpdf/fpdf.php')) {
			require LIBS.'fpdf/fpdf.php';
		} else { echo "not found"; exit;}

		if(isset($_POST['status'])) {
			require 'libs/Date.php';
			$ldate = new lib_date(); 

			$data = json_decode($_POST['data'], true);
			
			// $var = '{"barang":[{"id":"309","barang":"Ensiklopedia Islam","cur":"Rp","harga":"321000","qty":"1","total":321000},{"id":"1181","barang":"Mandiri  Bhs. Ind. SD Jl.1","cur":"Rp","harga":"39000","qty":"1","total":39000}],"website":"www.edu4indo.com","id_order":"3","customer":{"fn":"Test","ln":"Testing","email":"test@test.com"},"subtotal":360000}';
			// $data = json_decode($var, true);
			
			date_default_timezone_set("Asia/Jakarta");

			$date = time(date('dmYHis'));

			$jt = date('d m Y', strtotime("+14 Days"));
			$m = $ldate->get_month(substr($jt, 3, 2));
			$jt = str_replace(substr($jt, 3, 2), $m, $jt);

			$name = 'resources/file/'.$data['website'].'_'.$data['id_order'].'_'.$date.'.pdf';

			// GET ID INVOICE
			Database::executeS('INSERT INTO db_invoice VALUES(null,"'.$data['id_website'].'","'.$data['id_order'].'",null,"'.$_POST['status'].'")');

			$id['invoice'] = Database::executeS('SELECT * FROM db_invoice ORDER BY id_invoice DESC LIMIT 1');
			$id_invoice = $id['invoice'][0]['id_invoice'];

			
			$pdf = new FPDF('P', 'mm', array(210, 297));
			$pdf->AddPage();
			$pdf->Image(IMG_DIR.'invoice.png', 0,0,0);
			$pdf->Image(IMG_DIR.'list header.png',-1,110);

			// Set Website
			$pdf->SetFont('Arial','',18);
			$pdf->SetTextColor(255,255,255);
			$pdf->SetXY(110, 18);
			$pdf->Cell(80,10,'edu4indo','0',0,'R');


			$pdf->SetTextColor(0,0,0);


			// Set Nomor Invoice
			$pdf->SetFont('Arial','',16);
			$pdf->Text(32,57, $id_invoice);

			// Set Jatuh Tempo
			$pdf->SetFont('Arial','',12);
			$pdf->Text(53, 68.5, $jt);

			// Set ID ORDER
			$pdf->SetFont('Arial','',14);
			$pdf->Text(20, 105, 'ID ORDER '.$data['id_order']);


			$pdf->setXY(110, 45);
			$pdf->SetFont('Arial','',30);

			// Check Lunas / Belum Lunas
			if ($_POST['status'] == 1) {
				$pdf->SetTextColor(46,204,64);
				$pdf->Cell(80,10,'LUNAS',0,0,'R');
			} else {
				$pdf->SetTextColor(255,65,54);
				$pdf->Cell(80,10,'BELUM LUNAS',0,0,'R');
			}

			$pdf->SetTextColor(0,0,0);
			$pdf->SetFont('Arial','i',12);
			$pdf->Text(53,81,$data['customer']['fn'].' '.$data['customer']['ln'].' <'.$data['customer']['email'].'>');

			$height = 118;
			$count = 1;

			$pdf->SetFont('Arial','',12);
			foreach ($data['barang'] as $key) {
				$even = ($count % 2) == 0 ? ' even' : '';
				$pdf->Image(IMG_DIR.'list'.$even.'.png',-1,$height);

				$pdf->setXY(20,$height);
				$pdf->Cell(17,7,$key['id'],0);
				$pdf->setXY(40,$height);
				$pdf->Cell(80,7,$key['barang'],0);
				$pdf->setXY(121,$height);
				$pdf->Cell(24,7,$key['cur'].' '.$key['harga'],'0');
				$pdf->setXY(146,$height);
				$pdf->Cell(12,7,$key['qty'],'0');
				$pdf->setXY(160,$height);
				$pdf->Cell(12,7,$key['cur'].' '.$key['total'],'0');
				$pdf->Ln();

				$count++;
				$height += 7;
			}
			$pdf->setXY(125,$height+2);
			$pdf->Cell(12,7,'SUBTOTAL','0');
			$pdf->setXY(160,$height+2);
			$pdf->Cell(12,7,$data['barang'][0]['cur'].' '.$data['subtotal'],'0');

			//$pdf->Output();
			$pdf->Output($name,'F');
			Database::executeS('UPDATE db_invoice SET invoice = "'.$data['website'].'_'.$data['id_order'].'_'.$date.'.pdf'.'" WHERE id_invoice = "'.$id_invoice.'"');
		} else { return false;}
	}
    
    function readinvoice() {
		$file = 'resources/file/Just One_1_1392269773.pdf';
		$filename = 'Just One_1_1392269773.pdf';


		    header('Content-type: application/pdf');
		    header('Content-Disposition: inline; filename="' . $filename . '"');
		    header('Content-Transfer-Encoding: binary');
		    header('Content-Length: ' . filesize($file));
		    header('Accept-Ranges: bytes');

		    @readfile($file);
	}
    
	function newinvoice() {
		$this->view->render('invoice/create');
	}
}

?>