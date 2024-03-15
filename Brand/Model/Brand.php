<?php

class Brand_Model_Brand extends Core_Model_Abstract{
public function init(){
    $this->_resourceClass = "Brand_Model_Resource_Brand";
    $this->_collectionClass="Brand_Model_Resource_Collection_Brand";
}
}