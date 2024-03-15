<?php

class Catalog_Model_Product extends Core_Model_Abstract
{

    public function init()
    {
        $this->_resourceClass = 'Catalog_Model_Resource_Product';
        $this->_collectionClass = 'Catalog_Model_Resource_Collection_Product';
        // $this->_modelClass = 'catalog/product';
    }
    public function getStatus()
    {
        $mapping = [
            1 => "E",
            0 => "D"
        ];
        // var_dump($mapping);
        // echo"<pre>";
        // var_dump($this->_data);
        // var_dump($this->_data['status']);

        if(isset($this->_data['status'])){
            return $mapping[$this->_data['status']];
        }
    }

    public function getNameFromKey(){
        
    }

}