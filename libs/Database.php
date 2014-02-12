<?php 

/**
* DATABASE
*/
class Database
{
	
	function __construct()
	{
		$this->_dbConnect();
	}

	protected function _dbConnect() {
		mysql_connect(HOST, USERNAME, PASSWORD);
		mysql_select_db(DATABASE);
	}

	public function check() {
		echo 'Connect';
	}

	public function execute($sql) {
		$return = null;
		$query = mysql_query($sql);
		while ($show = mysql_fetch_assoc($query)) {
			$return[] = $show; 
		}
		return $return;
	}

	public static function executeS($sql) {
		$return = null;
		$query = mysql_query($sql);
		while (@$show = mysql_fetch_assoc($query)) {
			$return[] = $show; 
		}
		return $return;
	}

	public static function setDB($host, $user, $pass, $db) {
		mysql_connect($host, $user, $pass);
		mysql_select_db($db);
	}
}

?>