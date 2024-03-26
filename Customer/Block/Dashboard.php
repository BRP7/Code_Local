<?php
class Customer_Block_Dashboard extends Core_Block_Template
{
    public function __construct()
    {
        $this->setTemplate("customer/account/dashboard.phtml");
    }

    public function getCustomerOrder()
    {
        $customerId = Mage::getSingleton('core/session')->get("logged_in_customer_id");
       return Mage::getSingleton('sales/order')
            ->getCollection()
            ->addFieldToFilter('customer_id', $customerId);
            
        // $objOfOrder->getCollection()
        // ->addFieldToFilter('customer_id',$customerId)
        // ->getData();
        // print_r($objOfOrder);
        // print_r(Mage::getSingleton('sales/order')->getOrderItemCollection(Mage::getSingleton('sales/order')));
        // die;

    }

    public function getOrderItem($id){
            return Mage::getModel('sales/order_item')->getCollection()
            ->addFieldToFilter('order_id',$id);
        // }else{
        //     return Mage::getModel('sales/quote_item')->getCollection()
        //     ->addFieldToFilter('quote_id',$quoteId)
        //     ->addFieldToFilter('customer_id',Mage::getSingleton('core/session')->get("logged_in_customer_id"));
        // }
        
    }
}