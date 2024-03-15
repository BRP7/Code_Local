<?php

class Currencyconverter_Model_Resource_Currencyconverter extends Core_Model_Resource_Abstract{

    public function __construct(){
        $this->init("ccc_currency_converter","id");
    }
}