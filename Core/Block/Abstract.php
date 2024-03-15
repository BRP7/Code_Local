<?php

class Core_Block_Abstract {
     public $template;//core/1column.phtml
    public $data = [];
    // protected $_data;
    public function setTemplate($template){
        $this->template = $template;
        return $this;
    }
    
    public function getTemplate(){
        return $this->template; 

    }
    public function __get($key){
        return $this->template->$key;

    }
    public function __unset($key){
        $this->template->$key = null;

    }
    public function __set($key, $value){
        $this->template->$key = $value;

    }
    public function addData($key, $value){
        $this->template->addData($key, $value);

    }
    public function getData($key=null){
        return isset($this->data[$key]) ? $this->data[$key] : null;

    }
    public function setData($data){
        $this->_data = $data;
        // print_r($this->_data);
        return $this;
        // $this->template->setData($data);
    }
    // public function getUrl($action = null, $controller = null, $params = [], $resetParams = false){
        
    // }
    public function getUrl($path){
        return "http://localhost/practice/MVC/".$path;
    }
    public function getRequest(){

    }
    public function render(){
        include Mage::getBaseDir('App'). '/Design/frontend/template/' . $this->getTemplate();   
     }

}