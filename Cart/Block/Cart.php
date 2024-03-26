<?php

class Cart_Block_Cart extends Core_Block_Template
{
    public function __construct()
    {
        $this->setTemplate("customer/addToCart.phtml");
    }
    public function getCartItem()
    {
        $quoteId = Mage::getSingleton('core/session')->get('quote_id');
        if (Mage::getSingleton('core/session')->get('logged_in_customer_id')) {
            $customerId = Mage::getSingleton('core/session')->get('logged_in_customer_id');
            $data = Mage::getModel('sales/quote')->getCollection()
                ->addFieldToFilter('customer_id', $customerId)
                ->addFieldToFilter('order_id',0);
                // ->getFirstItem();
            foreach ($data->getData() as $value) {
                // $value->addData("quote_id",$quoteId)->save();
                Mage::getBlock('cart/cart')->mergeCart($value);
            }

        }
        
        // print_r(Mage::getModel('sales/quote_item')->getCollection()
        // ->addFieldToFilter('quote_id', $quoteId)->getData());
        // die;
        // if(!Mage::getSingleton("core/session")->get("logged_in_customer_id")){
        return Mage::getModel('sales/quote_item')->getCollection()
            ->addFieldToFilter('quote_id', $quoteId);
        // }else{
        //     return Mage::getModel('sales/quote_item')->getCollection()
        //     ->addFieldToFilter('quote_id',$quoteId)
        //     ->addFieldToFilter('customer_id',Mage::getSingleton('core/session')->get("logged_in_customer_id"));
        // }

    }
    public function quoteData(){
        // if (Mage::getSingleton('core/session')->get('logged_in_customer_id')) {
            // echo "<pre>";
            $quoteId = Mage::getSingleton('core/session')->get('quote_id');
             $data = Mage::getModel('sales/quote')->getCollection()
                ->addFieldToFilter('quote_id', $quoteId);
                return $data;
        // }
    }

    public function mergeCart($value)
    {
        // print_r($value->getQuoteId());
        // echo "<br>";
        $quoteId = Mage::getSingleton('core/session')->get('quote_id');
        // print_r($quoteId);
        $itemData = Mage::getModel('sales/quote_item')->getCollection()
            ->addFieldToFilter('quote_id', $value->getQuoteId());
        foreach ($itemData->getData() as $value) {
            $value->addData('quote_id',$quoteId)->save();
        }
    }
    public function getProductCollection()
    {
        return Mage::getModel('sales/quote')->getItemCollection();
    }
    public function getQuoteCollection($id)
    {
        return Mage::getModel('sales/quote')->getQuoteCollectionByQuoteId($id);
    }
}

?>