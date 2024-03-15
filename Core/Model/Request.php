<?php
class Core_Model_Request
{

	public function getParams($key = '', $arg = null) {
		return ($key == '')
			? $_REQUEST
			: (isset($_REQUEST[$key])
				? $_REQUEST[$key]
				: ((!is_null($arg)) ? $arg : '')
			);
	}


	public function getPostData($key = '')
	{
		return ($key == '')
			? $_POST
			: (isset($_POST[$key])
				? $_POST[$key]
				: ''
			);
	}

	public function getQueryData($key = '')
	{
		return ($key == '')
			? $_GET
			: (isset($_GET[$key])
				? $_GET[$key]
				: ''
			);
	}

	public function isPost()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			return true;
		}
		return false;
	}

	public function getRequestUri()
	{
		$requstUri = $_SERVER['REQUEST_URI'];
		$uri = str_replace('/practice/MVC/', '', $requstUri);
		if(strpos($uri,'?') !== false) //? position return krse ? je value api hase eni ane nai male toh flase return krse
			$uri = stristr($uri, '?', True); // ? ni agal ni puri string return kre
		// print_r($uri);
		return $uri;
	}
	protected $_controllerName, $_moduleName, $_actionName;

	public function getModuleName()
	{
		return $this->_moduleName;
	}
	public function getControllerName()
	{
		return $this->_controllerName;
	}
	public function getActionName()
	{
		return $this->_actionName;
	}
	public function __construct()  
	{
		$requestUri = $this->getRequestUri(); //id pela nu malse 
      $requestUri = array_filter(explode('/', $requestUri)); //veriable ma url mali 
        // print_r($requestUri);
		//-> access kre
        $this->_moduleName = isset( $requestUri[0]) ?  $requestUri[0] : "page";
        $this->_controllerName = isset( $requestUri[1]) ?  $requestUri[1] : "index";
        $this->_actionName =isset( $requestUri[2]) ?  $requestUri[2] : "index";
	}
	public function getFullControllerClass()
	{
		// // Page_Controller_index
		// $model = $this->_moduleName;
		// $contro = $this->_controllerName;
		// return ucfirst($model) .'_Controller_' .ucfirst($contro);
		$controllerClass = implode('_', [ucfirst($this->_moduleName), 'Controller', ucfirst($this->_controllerName)]);
		// $controllerClass=stristr($controllerClass,'?',true);  admin_controller_catalog_product
        return $controllerClass;
	}
}
