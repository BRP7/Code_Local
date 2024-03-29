<?php

class Customer_Block_View extends Core_Block_Template{

    public function __construct(){
        $this->setTemplate('customer/view.phtml');
    }

    public function getOrders(){
        $customerId = Mage::getSingleton('core/session')->get('logged_in_customer_id');
        if($customerId){
             return  Mage::getModel('sales/quote')->getOrderCollection()->addFieldToFilter('customer_id',$customerId)->getData();
        }else{
            echo "Login to See Your Order";
        }
    }

    // public function getOrderItems()
    // {
    //     foreach($this->getOrders() as $_order){
    //         return  Mage::getModel('sales/quote')->getOrderItemCollection($_order);
    //     }
    // }

    public function getOrderItems()
    {
        $_items = [];
        if ($this->getOrders()) {
            foreach ($this->getOrders() as $_order) {
                $_items[] = Mage::getModel('sales/order')->getOrderItemCollection($_order)->getData();
                // print_r($_items);
            }
        }
        return $_items;
    }
}
?>