<?php

class Sales_Model_Order_Item extends Core_Model_Abstract
{
    public function init()
    {
        $this->_resourceClass = 'Sales_Model_Resource_Order_Item';
        $this->_collectionClass = 'Sales_Model_Resource_Collection_Order_Item';
        // $this->_modelClass = 'sales/quote_item';
    }

    protected $_item=null;

    public function getProduct()
    {
        if(is_null($this->_item)){
           $this->_item = Mage::getModel('catalog/product')->load($this->getProductId());
        }
        return $this->_item;
    }

}