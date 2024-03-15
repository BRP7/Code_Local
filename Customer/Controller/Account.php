<?php

class Customer_Controller_Account extends Core_Controller_Front_Action
{
    // public function __construct(){

    // }
    protected $_allowedActions = ['login','register'];

    public function init(){
        // $this->getRequest()->getActionName();
        if(!in_array($this->getRequest()->getActionName(), $this->_allowedActions) &&
                !Mage::getSingleton('core/session')->get("logged_in_customer_id")) 
        {
            $this->setRedirect('customer/account/login');
        }
    }

    public function registerAction()
    {
        $layout = $this->getLayout();
        $this->setFormCss("form");
        $child = $layout->getChild('content');
        $layout->removeChild('header')->removeChild('footer');
        // $layout->getChild('head')->addCss('form.css');
        $register = $layout->createBlock('customer/register')->setTemplate('customer/account/register.phtml');
        $child->addChild('register', $register);
        $layout->toHtml();
    }

    public function saveAction()
    {
        $data = $this->getRequest()->getParams('customer');
        $productModel = Mage::getmodel('customer/customer');
        $productModel->setData($data);
        $result = $productModel->save();
        
            if($result){
                echo '<script>alert("Data insert successfully")</script>';
                echo "<script>location.href='" . Mage::getBaseUrl() . '/customer/account/login' . "'</script>";
             }
        else{
            echo '<script>alert("OOPS! Something Went Wrong !!!! ")</script>';
            echo "<script>location.href='" . Mage::getBaseUrl() . '/customer/account/register' . "'</script>";
        }
    }

    public function deleteAction(){

    }

    public function loginAction(){
    if(isset($_POST["submit"])){
        $data = $this->getRequest()->getParams("login");
        $model= Mage::getModel("customer/customer");
        $result =   $model->getCollection()
        ->addFieldToFilter("customer_email", $data["customer_email"])
        ->addFieldToFilter("password", $data["password"]);
        $count=0;
        $customerId =0;
        foreach($result->getData() as $row){
            $count++;
            $customerId = $row->getCustomerId();
        }
        if($count){
            Mage::getSingleton("core/session")->set("logged_in_customer_id",$customerId);
            $this->setRedirect("customer/account/dashboard");
        }
        else{
            $this->setRedirect("customer/account/login");    
        }

    }
    else{   
        $layout = $this->getLayout();
        $layout->removeChild('header')->removeChild('footer');
        $child = $layout->getChild('content');
        $layout->getChild('head')->addCss('form.css');//addCss('header.css')
        $login = $layout->createBlock('customer/login')->setTemplate('customer/account/login.phtml');
        $child->addChild('login', $login);
        $layout->toHtml();
    }
    }

    public function dashboardAction(){
       $sessionId = Mage::getSingleton("core/session")->get("logged_in_customer_id");
       if($sessionId){
        $layout = $this->getLayout();
        $this->setFormCss('dashboard');
        $child = $layout->getChild('content');
        $dashboard = $layout->createBlock('customer/dashboard');
        $child->addChild('dashboard', $dashboard);
        $layout->toHtml();
       }
    }

    public function logoutAction(){}

    


}