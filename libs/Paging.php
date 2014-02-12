<?php

class Paging {

	public $per_page = 5;
	public $query = '';
	public $c_query = '';
	public $count = 0;
	public $name = '';

	public function name($name) {
		$this->name = $name;
	}

	public function set($table, $per_page = null) {
		$this->query = 'SELECT * FROM '.$table;
		$this->c_query = $this->query;

		if(!empty($per_page))
			$this->per_page = $per_page;
	}

	// join('db_cms', db_cms.id = db_web.id)
	public function join($table, $clause) {
		$this->query .= ' INNER JOIN '.$table.' ON '.$clause;
	}

	public function clause($clause) {
		$this->query = ' '.$clause;
	}

	function limit($page = 0) {
		if(Session::get('paging-'.$this->name) != null) {
			$page = Session::get('paging-'.$this->name)-1;
		}
		#$page = !empty(Session::get('paging-'.$this->name)) ? Session::get('paging-'.$this->name)-1 : 0;
		$start = $page * $this->per_page;
		$this->query .= ' LIMIT '.$start.','.$this->per_page;
	}

	public function create() {
		$data = Database::executeS( $this->query );
		return $data;
	}

	private function total() {
		$data = str_replace('*', 'count(*) as count', $this->c_query);
		$count = Database::executeS($data);
		return $count[0]['count'];
	}

	public function show() {
		$sc = '<ul class="pagination" style="margin:0px;">';
		$noPage = ceil( $this->total() / $this->per_page );
		for ($i=1; $i <= $noPage; $i++) { 
			$class = (Session::get('paging-'.$this->name) == $i) ? "active" : "";
			$sc .= '<li class="'. $class .'"><a href=';

			if($class == "active")
				$sc .= "#";
			else
				$sc .= '"'.URL.'page/set/'.$this->name.'/'.$i.'"';

			$sc .= ' id="page'.$i.'">'.$i.'</a>';
			$sc .= '</li>';
		}
		$sc .= '</ul>';
		echo $sc;
	}
}

?>