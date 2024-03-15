<?php

class Admin_Controller_Banner extends Core_Controller_Admin_Action{

    protected $_allowedActions=['form'];

    public function formAction(){
        $this->setFormCss("form");
        $layout = $this->getLayout();
        $child = $layout->getChild('content');
        $productForm = $layout->createBlock('banner/admin_form');//constructor
        $child->addChild('form', $productForm);
        $layout->toHtml();
    }

    
    public function saveAction()
    {
        $data = $this->getRequest()->getparams("banner");
        $product = Mage::getModel('banner/banner')
            ->setData($data);
        $result = $product->save();
        if ($data['banner_id']) {
            if($result){
                echo '<script>alert("Data updated successfully")</script>';
                echo "<script>location.href='" . Mage::getBaseUrl() . 'admin/banner/list' . "'</script>";
            }
        }
        else{
            echo '<script>alert("Data inserted successfully")</script>';
            echo "<script>location.href='" . Mage::getBaseUrl() . 'admin/banner/list' . "'</script>";
        }
        
    }
    public function deleteAction()
    {
        $id = $this->getRequest()->getparams("id");
        $product = Mage::getModel("banner/banner")->load($id);
        $result = $product->delete();
        if ($result){
            echo "<script>alert('data deleted sucessfully')</script>";
            echo "<script>location.href='" . Mage::getBaseUrl() . 'admin/banner/list' . "'</script>";
        }

    }

    public function listAction(){
        $layout = $this->getLayout();
        $child = $layout->getchild('content'); 
        $productForm = $layout->createBlock('banner/admin_list');
        $child->addchild('list', $productForm);
        $layout->toHtml();
    }
}