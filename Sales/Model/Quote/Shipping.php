<?php

class Sales_Model_Quote_Shipping extends Core_Model_Abstract{
    public function init()
    {
        $this->_resourceClass = 'Sales_Model_Resource_Quote_Shipping';
        $this->_collectionClass = 'Sales_Model_Resource_Collection_Quote_Shipping';
        // $this->_modelClass = 'sales/quote_item';
    }

    public function _beforeSave(){
        // $customerId = Mage::getSingleton('core/session')->get('logged_in_customer_id');
        $quoteId = Mage::getSingleton('core/session')->get('quote_id');
        // $this->addData('customer_id',$customerId)
        $this->addData('quote_id',$quoteId);
    }

}
?>