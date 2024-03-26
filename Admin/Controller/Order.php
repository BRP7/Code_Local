<?php

class Admin_Controller_Order extends Core_Controller_Front_Action{

    public function cancleAction(){
       $data = $this->getRequest()->getPostData('order');
    //    print_r($data['order_id']);
    //    die;
       Mage::getModel('sales/order_history')->setData($data)
                            ->save();
       Mage::getSingleton('core/session')->set('order_cancle_request',$data['order_id']);
        // if(Mage::getSingleton('core/session')->get('logged_in_admin_user_id')){
        //     $this->setRedirect('admin/user/details');
        // }
        $this->setRedirect('customer/account/dashboard');
    }
}

?>