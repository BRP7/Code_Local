<?php

class Admin_Block_Details extends Core_Block_Template{

    public function __construct(){

    }

    public function getOrderCollection($id)
    {
        return Mage::getModel('sales/order')->load($id);
    }
    
    public function getOrders(){
        return  Mage::getModel('sales/quote')->getOrderCollection()->getData();
      }
    public function getOrderHistoryCollection($id){
        return  Mage::getModel('sales/order_history')->getCollection()
        ->addFieldToFilter('order_id',$id);
        
        // ->getData();
      }
      public function getPaymentMethod($id)
      {
          return Mage::getModel('sales/order_payment')->load($id);
      }
      public function getShippingMethod($id)
      {
          return Mage::getModel('sales/order_shipping')->load($id);
      }
      public function getCustomerMethod($id)
      {
          return Mage::getModel('sales/order_customer')->load($id);
      }

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