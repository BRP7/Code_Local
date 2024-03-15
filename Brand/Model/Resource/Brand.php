<?php

class Brand_Model_Resource_Brand extends Core_Model_Resource_Abstract{

    public function __construct(){
        $this->init("brand","brand_id");
    }

}