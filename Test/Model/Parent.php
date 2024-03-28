<?php

class Test_Model_Parent extends Core_Model_Abstract{

    public function init(){
        $this->_resourceClass = "Test_Model_Resource_Parent";
        $this->_collectionClass="Test_Model_Resource_Collection_Parent";
    }

    // public function getStateIdName()
    // {
    //     $state = [];
    //     $stateCollection = $this->getCollection();
    //     foreach ($stateCollection->getData() as $_state) {
    //         $state[$_state->getId()] = $_state->getName();
    //     }
    //     return $state;
    // }

    
}