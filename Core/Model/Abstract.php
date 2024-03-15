<?php
class Core_Model_Abstract
{
    public function __construct()
    {
        $this->init();
    }
    public function init()
    {
    }
    protected $_data = [];
    protected $_resourceClass = '';
    protected $_collectionClass = '';
    protected $_resource = null;
    protected $_collection = null;

    protected $_status = null;
    // protected $_modelClass = null;
    // public function __construct(){}
    public function setResourceClass($resourceClass)
    {
    }
    public function setCollectionClass($collectionClass)
    {
    }
    public function setId($id)
    {
        $this->_data[$this->getResource()->getPrimaryKey()] = $id;
        return $this;
    }
    public function getId()
    {
        // print_r(debug_backtrace());

        return (isset($this->_data[$this->getResource()->getPrimaryKey()]))
         ? $this->_data[$this->getResource()->getPrimaryKey()]
         : 0 ;//$this->_data['product_id']
    }
 

    public function getResource()
    {
        // $modelClass = get_class($this);
        // $modelClass = str_replace('_Model_', '_Model_Resource_', $modelClass);        
        // return new $modelClass();
        // echo $this->_resourceClass;
        return new $this->_resourceClass(); // catalog_model_resource_product no calass banse eno object avse
    }
    public function getCollection()
    {
        $collection = new $this->_collectionClass(); 
        $collection->setResource($this->getResource());   
        // $collection->setModelCLass($this->_modelClass);    
        $collection->setModelCLass(get_class($this));    
        $collection->select(); //Core_Model_Resource_Collection_Abstract 
        return $collection;

    }

    public function getTableName()
    {
    }
    public function camelCase2UnderScore($str, $separator = "_")
    {
        if (empty($str)) {
            return $str;
        }
        $str = lcfirst($str);
        $str = preg_replace("/[A-Z]/", $separator . "$0", $str);
        return strtolower($str);
    }
    public function __call($method, $args)
    {
        $name = $this->camelCase2UnderScore(substr($method, 3));
        return isset($this->_data[$name]) ? $this->_data[$name] : '';
    }
    public function __set($key, $value)
    {
    }
    public function __get($key)
    {
    }
    public function __unset($key)
    {
    }
    public function getData($key = null)
    {
        return $this->_data;
    }
    public function setData($data)
    {
        $this->_data = $data;
        return $this;
    }
    public function addData($key, $value)
    {
        $this->_data[$key] = $value;
        return $this;
    }
    public function removeData($key = null)
    {
        if (isset($this->_data[$key])) {
            unset($this->_data[$key]);
        }
        return $this;
    }

    protected function _beforeSave() {

    }
    protected function _afterSave() {
        
    }
    public function save()
    {
        // print_r(get_class($this));
        $this->_beforeSave();
        $this->getResource()->save($this); 
        $this->_afterSave();
        return $this;
    }
    public function load($id, $column = null)
    {
        //    $this->getResource();
        $this->_data = $this->getResource()->load($id, $column);
        // print_r($this->_data);
        return $this;
    }
    public function delete()
    {
        // echo 123;
        if ($this->getId()) {
            $this->getResource()->delete($this);
        }
        return $this;
    }

}