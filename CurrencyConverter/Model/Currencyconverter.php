<?php

class Currencyconverter_Model_Currencyconverter extends Core_Model_Abstract{
    public function init(){
        $this->_resourceClass = "Currencyconverter_Model_Resource_Currencyconverter";
        $this->_collectionClass="Currencyconverter_Model_Resource_Collection_Currencyconverter";
    }

}