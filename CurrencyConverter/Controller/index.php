<?php

class CurrencyConverter_Controller_Index extends Core_Controller_Front_Action{

    protected $_userName = 'abcabc@gmail.com';

    protected $_password = 'npmi';

    public function loginAction()
    {
        if (isset($_POST["submit"])) {
            $data = $this->getRequest()->getParams("login");
            if ($data["customer_email"] == $this->_userName) {
                if ($data["password"] == $this->_password) {
                    $adminId = 1;
                    Mage::getSingleton("core/session")->set("logged_in_admin_user_id", $adminId);
                    $this->setRedirect("currencyconverter/index/form");
                } else {
                    $this->setRedirect("admin/user/login");
                }
            }
            else {
                echo "Please Enter valid Username & Password!";
                $this->setRedirect("admin/user/login");
            }

        } else {
            $layout = $this->getLayout();
            $layout->removeChild('header')->removeChild('footer');
            $child = $layout->getChild('content');
            $layout->getChild('head')->addCss('form.css');
            $login = $layout->createBlock('customer/login')->setTemplate('admin/login.phtml');
            $child->addChild('login', $login);
            $layout->toHtml();
        }
    }
    public function formAction(){
        $this->setFormCss("form");
        $layout = $this->getLayout();
        $child = $layout->getChild("content");
        $brand = $layout->createBlock("currencyconverter/form")->setTemplate("currencyconverter/form.phtml");
        $child->addChild('form',$brand);
        $layout->toHtml();
    }

    public function saveAction(){
        $data = $this->getRequest()->getPostData('cur');
        $result = ($data['amount']*$data['country']) / $data['currency_country'];
        $data = $data + ['result'=>$result];
        // print_r($data);
        $save = Mage::getModel('currencyconverter/currencyconverter')->setData($data)->save();
        if($save){
            $this->setRedirect("currencyconverter/index/form");   
        }
    } 
    //  }
        // $brand = Mage::getModel('brand/brand')->setData($data);
        // $result = $brand->save();
        // if($result){
        //     echo "<script>alert('insertion successfully')</script>";
        //     $this->setRedirect("brand/index/list");
        // }else{

        // }
       
        public function deleteAction(){ 
            $id = $this->getRequest()->getParams('id');
            $result = Mage::getModel('currencyconverter/currencyconverter')->load($id)->delete();
            if($result){
                echo "<script>alert('delete successfully')</script>";
            }
        }

        public function deleteAllAction(){ 
            $result = Mage::getModel('currencyconverter/currencyconverter')->deleteAll();
            if($result){
                echo "<script>alert('delete successfully')</script>";
            }
        }
    
}