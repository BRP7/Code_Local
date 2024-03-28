<?php

class Test_Model_Child extends Core_Model_Abstract{
    public function init(){
        $this->_resourceClass = "Test_Model_Resource_Child";
        $this->_collectionClass="Test_Model_Resource_Collection_Child";
    }

}