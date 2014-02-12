<?php 

/**
* 
*/
class error extends Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index() {}

    function page($err) {
    	switch($err){
    		case 404:
    			echo "404 not found";	
    		break;
    	}
    }
}
?>