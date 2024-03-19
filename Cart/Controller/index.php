<?php
class Cart_Controller_index extends Core_Controller_Front_Action{
    
    public function cartAction() {
        $this->setFormCss("addToCart");
        $layout = $this->getLayout();
        $child = $layout->getChild("content");
        $cart = $layout->createBlock("cart/cart");
        $child->addChild('form',$cart);
        $layout->toHtml();
        
    }
    // public function checkoutAction() {
      
    //     if($cutomerId){
         
    //     }   $this->setFormCss("checkout");
    //         $layout = $this->getLayout();
    //         $child = $layout->getChild("content");
    //         $brand = $layout->createBlock("cart/checkout")->setTemplate("customer/checkout.phtml");
    //         $child->addChild('form',$brand);
    //         $layout->toHtml();
     
        
    // }

    public function orderAction(){
        echo "Order Placed(❁´◡`❁)";
    }

    public function saveAction(){
        $data =  $this->getRequest()->getParams('sales_quote_customer');
        $quote = Mage::getModel('cart/address')->addAddress($data);
        //  print_r($data);
    }
}
?>