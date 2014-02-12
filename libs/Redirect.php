<?php 

/**
* REDIRECT
*/
class Redirect
{
	
	public function to($loc) {
		header('location:'.$loc);
	}

}

?>