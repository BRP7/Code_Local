<?php
class Cart_Block_Checkout extends Core_Block_Template{
    

    public function getCustomerId(){
        $customerId = Mage::getSingleton('core/session')->get('logged_in_customer_id');
        // print_r($customerId);
        return $customerId;
    }
    public function getQuoteCustomerData(){
        
    }

    protected $payment = ['COD','Credit Card','UPI'];
    protected $item;
    public function getProductCollection(){
        
        return  Mage::getModel('sales/quote')->getItemCollection();
       
    }
}

?>