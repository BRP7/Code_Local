<?php
class Sales_Controller_Quote extends Core_Controller_Front_Action{

    

    public function addAction() {
        $data =  $this->getRequest()->getParams('cart');
        // print_r($data);
        $quote = Mage::getModel('sales/quote')->addProduct($data);
        $this->setRedirect('cart/index/cart');
    }
    // public function CheckoutAction() {
    //     $customerId = Mage::getSingleton("core/session")->get("logged_in_customer_id");
    //     $this->checkDataAndRedirect(['customer/account/login'=>$customerId]);
    //          $request = ['quote_id' => $this->getRequest()->getParams('qid'),
    //                         'item_id' => $this->getRequest()->getParams('id'),
    //                         'product_id' => $this->getRequest()->getParams('pid')];
    //          $quote = Mage::getSingleton('sales/quote')->checkProduct($request);   

        
    //     }

    public function saveAction(){
        
            $data =  $this->getRequest()->getParams('sales_quote_customer');
            $paymentData = $this->getRequest()->getParams('payment');
            $shippingData = $this->getRequest()->getParams('shipping');
            // print_r($shippingData);
            $quote = Mage::getSingleton('sales/quote');
            $quote->addAddress($data);
            $quote->addPayment($paymentData);
            $quote->addShipping($shippingData);
            $quote->convertToOrder();
            // $quote = Mage::getSingleton('core/session')->get('quote_id');
            Mage::getSingleton('core/session')->remove('quote_id');
           
            $this->setRedirect('customer/account/dashboard');
            //  print_r($paymentData);
       
     
    }
  
    public function deleteAction() {
    //  $request =  $this->getRequest()->getQueryData('id');
     $request = ['quote_id' => $this->getRequest()->getParams('qid'),
                    'item_id' => $this->getRequest()->getParams('id')];
     $quote = Mage::getSingleton('sales/quote')->removeProduct($request);  
     $this->setRedirect('cart/index/cart'); 
    }

}