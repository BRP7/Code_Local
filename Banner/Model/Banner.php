<?php

class Banner_Model_Banner extends Core_Model_Abstract
{
    public function init(){
        $this->_resourceClass = "Banner_Model_Resource_Banner";
        $this->_collectionClass = "Banner_Model_Resource_Collection_Banner";
    }
    public function getStatus()
    {
        $mapping = [
            1 => "E",
            0 => "D"
        ];

        if(isset($mapping[$this->_status]))
            return $mapping[$this->_data['status']];
    }
}