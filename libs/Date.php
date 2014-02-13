<?php

class lib_date {

	public $values = [];

	function __construct() {
		date_default_timezone_set("Asia/Jakarta");
	}

	function get_month($val = 1) {
		switch($val) {
			case 1: $m = "Januari"; break;
			case 2: $m = "Februari"; break;
			case 3: $m = "Maret"; break;
			case 4: $m = "April"; break;
			case 5: $m = "Mei"; break;
			case 6: $m = "Juni"; break;
			case 7: $m = "Juli"; break;
			case 8: $m = "Agustus"; break;
			case 9: $m = "September"; break;
			case 10: $m = "Oktober"; break;
			case 11: $m = "November"; break;
			case 12: $m = "Desember"; break;
		}
		return $m;
	}

}

?>