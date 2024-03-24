<?php

class Admin_Controller_User extends Core_Controller_Admin_Action
{
    protected $_allowedActions = array('login');

    protected $_userName = 'abcabc@gmail.com';

    protected $_password = 'npmi';

    public function loginAction()
    {
        // $email =  $data["customer_email"];
        // print_r($data);
        // $result =   $model->getCollection()
        // ->addFieldToFilter("customer_email", $data["customer_email"])
        if (isset ($_POST["submit"])) {
            $data = $this->getRequest()->getParams("login");
            if ($data["customer_email"] == $this->_userName) {
                if ($data["password"] == $this->_password) {
                    $adminId = 1;
                    Mage::getSingleton("core/session")->set("logged_in_admin_user_id", $adminId);
                    $this->setRedirect("admin/user/dashboard");
                } else {
                    $this->setRedirect("admin/user/login");
                }
            }
            // $model= Mage::getModel("customer/customer");
            // print_r($data);
            // $result =   $model->getCollection()
            // ->addFieldToFilter("customer_email", $this->_userName) // Replaced with $_userName
            // ->addFieldToFilter("password", $this->_password);
            // $count=0;
            // $customerId =0;
            // foreach($result->getData() as $row){
            //     $count++;
            //     $customerId = $row->getCustomerId();
            // }
            // if($count){
            //     Mage::getSingleton("core/session")->set("logged_in_customer_id",$customerId);
            //     $this->setRedirect("customer/account/dashboard");
            // }
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

    public function dashboardAction()
    {
        $sessionId = Mage::getSingleton("core/session")->get("logged_in_admin_user_id");
        if ($sessionId) {
            $this->setFormCss('adminDashboard');
            $layout = $this->getLayout();
            $child = $layout->getChild('content');
            $login = $layout->createBlock('admin/dashboard');
            $child->addChild('login', $login);
            $layout->toHtml();
        }
    }

    public function orderAction()
    {
        $this->setFormCss("order");
        $layout = $this->getLayout();
        $child = $layout->getchild('content'); //core_block_layout
        $productForm = $layout->createBlock('customer/admin_view');
        $child->addChild('view', $productForm);
        $layout->toHtml();
    }
    public function editAction()
    {
        $id = $this->getRequest()->getparams("id");
        $this->setFormCss("orderEdit");
        $layout = $this->getLayout();
        $child = $layout->getchild('content'); //core_block_layout
        $productForm = $layout->createBlock('customer/admin_edit')->setTemplate('customer/edit.phtml');
        $child->addChild('view', $productForm);
        $layout->toHtml();
    }
    public function saveAction()
    {
        $paramData = $this->getRequest()->getparams();
        Mage::getModel('sales/order')->historySave($paramData);
        // $data = $this->getRequest()->getPostData("status");
        $dataAll = Mage::getModel('sales/order')->getCollection()
            ->addFieldToFilter('order_id', $paramData['id'])
            ->getFirstItem();
        $dataAll->addData('status', $paramData['status'])
            ->save();
        print_r($dataAll);
        $this->setRedirect('admin/user/order');
    }

    // public function listAction()
    // {
    //     $layout = $this->getLayout();
    //     $requstUri = $_SERVER['REQUEST_URI'];
    //     $findQues = stristr($requstUri, '?');
    //     $findQues = substr($findQues, 4);
    //     // echo "<pre>";
    //     // echo "$findQues";
    //     // die;
    //     if ($findQues) {
    //         $child = $layout->getchild('content'); //core_block_layout
    //         $productForm = $layout->createBlock('admin/list');
    //         $child->addchild('list', $productForm);
    //     } else {
    //         $child = $layout->getchild('content'); //core_block_layout
    //         $productForm = $layout->createBlock('catalog/admin_product_list');
    //         $child->addchild('list', $productForm);
    //     }
    //     $layout->toHtml();
    // }
}