<?php
class Cart_Controller_Checkout extends Core_Controller_Front_Action
{

    public function CheckoutAction()
    {
        $qtyCheck = Mage::getModel('sales/quote')->checkQty();
        if (!$qtyCheck) {


            // $data = $this->getRequest()->getparams('cartData');
            Mage::getSingleton('core/session')->set('order', 'orderAction');
            $quoteId = Mage::getSingleton("core/session")->get("quote_id");
            if (Mage::getSingleton('core/session')->get('logged_in_customer_id')) {
                $this->setFormCss("checkout");
                $this->setJs('jquery-3.7.1');
                // if(){

                // }else{
                $layout = $this->getLayout();
                $child = $layout->getChild("content");
                $checkout = $layout->createBlock("cart/checkout")->setTemplate("customer/checkout.phtml");
                $child->addChild('form', $checkout);
                $layout->toHtml();
                // }
            } else {
                $this->setRedirect('customer/account/login');

                if (!$quoteId) {
                    // $this->setRedirect('customer/account/login');
                    $this->checkDataAndRedirect(['catalog/product/view' => $quoteId]);
                    // }
                }

            }

            // if(!$quoteId){
            //     $this->setRedirect('customer/account/login');
            //     $this->checkDataAndRedirect(['catalog/product/view'=>$quoteId]);
            // }else{
            //     $this->setFormCss("checkout");
            //     $this->setJs('jquery-3.7.1');
            //     $layout = $this->getLayout();
            //     $child = $layout->getChild("content");
            //     $checkout = $layout->createBlock("cart/checkout")->setTemplate("customer/checkout.phtml");
            //     $child->addChild('form',$checkout);
            //     $layout->toHtml();


            // }

        } else {
          echo '<script>alert("Some Items are out of stock please check.")</script>';
          $this->setRedirect('cart/index/cart?id='.$qtyCheck);
        }
    }
}
?>