<?php
class Sales_Controller_Quote extends Core_Controller_Front_Action
{



    public function addAction()
    {
        //taking cart data ProductId & Qty in case of add & item,quote id included for update 
        $data = $this->getRequest()->getParams('cart');
        Mage::getModel('sales/quote')->addProduct($data);
        //after successful insertion or updatation 
        $this->setRedirect('cart/index/cart');
    }


    public function saveAction()
    {
        //taking individual data from single form for different table 
        $customerData = $this->getRequest()->getParams('sales_quote_customer');
        $paymentData = $this->getRequest()->getParams('payment');
        $shippingData = $this->getRequest()->getParams('shipping');

        $quote = Mage::getSingleton('sales/quote');

        $quote->addAddress($customerData);
        $quote->addPayment($paymentData);
        $quote->addShipping($shippingData);

        //after successful Quote entries Converted into order
        $quote->convertToOrder();

        //after add to cart remove the product from cart
        Mage::getSingleton('core/session')->remove('quote_id');

        //after successful order place redirecting to dashboard
        $this->setRedirect('customer/account/dashboard');



    }

    public function deleteAction()
    {
        //according to current code quote_id get from session is also work
        //because now we are making sure that for same customer quote_id won't change 
        $request = [
            'quote_id' => $this->getRequest()->getParams('qid'),
            'item_id' => $this->getRequest()->getParams('id')
        ];
        // print_r(Mage::getSingleton('core/session')->get('quote_id'));
        // print_r($request['quote_id']);
        Mage::getSingleton('sales/quote')->removeProduct($request);
        $this->setRedirect('cart/index/cart');
    }

}