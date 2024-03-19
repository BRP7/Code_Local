<?php

class Customer_Block_Admin_Edit extends Core_Block_Template{

    public function __construct(){
        $this->setTemplate('customer/edit.phtml');
    }

    public function getOrders(){
      return  Mage::getModel('sales/quote')->getOrderCollection()->getData();
    }

    // public function getOrderItems()
    // {
    //     foreach($this->getOrders() as $_order){
    //         return  Mage::getModel('sales/quote')->getOrderItemCollection($_order);
    //     }
    // }

    public function getOrderItems($id)
    {
        $_items = [];
        if ($this->getOrders()) {
            foreach ($this->getOrders() as $_order) {
                $_items[] = Mage::getModel('sales/order')->getOrderItemCollection($_order)
                ->addFieldToFilter('item_id',$id)
                ->getData();
                // print_r($_items);
            }
        }
        return $_items;
    }
}
?>