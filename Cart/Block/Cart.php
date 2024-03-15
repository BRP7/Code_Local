<?php

class Cart_Block_Cart extends Core_Block_Template{
    public function __construct(){
        $this->setTemplate("customer/addToCart.phtml");
    }
    public function getCartItem(){
        $quoteId = Mage::getSingleton('core/session')->get('quote_id');
        return Mage::getModel('sales/quote_item')->getCollection()
        ->addFieldToFilter('quote_id',$quoteId);;
    }
}

?>