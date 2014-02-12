<?php 

/**
* 
*/
class Bootstrap
{

	private $_url = null;
	private $_controller = null;
	
	function __construct()
	{	
		$this->_getUrl();

		if(empty($this->_url[0])) {
			require 'controllers/index.php';
			$controller = new Index();
			$controller->index();
			return false;
		}

		$this->_loadExistingController();
		$this->_callControllerMethod();

	}

	private function _getUrl()
	{
		$url = isset($_GET['u']) ? $_GET['u'] : null;
		$url = rtrim($url, '/');
		$url = filter_var($url, FILTER_SANITIZE_URL);
		return $this->_url = explode('/', $url);
	}

	private function _loadExistingController() {
		$file = 'controllers/'. $this->_url[0] .'.php';
		if(file_exists($file)) {
			require $file;
			$this->_controller = new $this->_url[0]();
		} else {
			$this->_error();
			return false;
		}
	}

	/**
     * If a method is passed in the GET url paremter
     * 
     *  http://localhost/controller/method/(param)/(param)/(param)
     *  url[0] = Controller
     *  url[1] = Method
     *  url[2] = Param
     *  url[3] = Param
     *  url[4] = Param
     */
    private function _callControllerMethod()
    {
        $length = count($this->_url);
        
        // Make sure the method we are calling exists
        if ($length > 1) {
            if (!method_exists($this->_controller, $this->_url[1])) {
                $this->_error();
            }
        }
        
        // Determine what to load
        switch ($length) {
            case 5:
                //Controller->Method(Param1, Param2, Param3)
                $this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3], $this->_url[4]);
                break;
            
            case 4:
                //Controller->Method(Param1, Param2)
                $this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3]);
                break;
            
            case 3:
                //Controller->Method(Param1, Param2)
                $this->_controller->{$this->_url[1]}($this->_url[2]);
                break;
            
            case 2:
                //Controller->Method(Param1, Param2)
                $this->_controller->{$this->_url[1]}();
                break;
            
            default:
                $this->_controller->index();
                break;
        }
    }

	private function _error() {
		require 'controllers/error.php';
		$controller = new Error();
		$controller->page(404);
		exit;
	}
}

?>