<?php
class Brand_Controller_Index extends Core_Controller_Front_Action{

    public function formAction(){
        $this->setFormCss("form");
        $layout = $this->getLayout();
        $child = $layout->getChild("content");
        $brand = $layout->createBlock("brand/brand")->setTemplate("brand/form.phtml");
        $child->addChild('form',$brand);
        $layout->toHtml();
    }

    public function listAction(){
        $this->setFormCss("list");
        $layout = $this->getLayout();
        $child = $layout->getChild("content");
        $brand = $layout->createBlock("brand/brand")->setTemplate("brand/list.phtml");
        $child->addChild('form',$brand);
        $layout->toHtml();
    }

    public function saveAction(){
        $data = $this->getRequest()->getPostData('brand');
        // $layout= $this->getLayout();
        $brand = Mage::getModel('brand/brand')->setData($data);
        $result = $brand->save();
        if($result){
            echo "<script>alert('insertion successfully')</script>";
            $this->setRedirect("brand/index/list");
        }else{

        }

    }

    public function deleteAction(){
        $id = $this->getRequest()->getParams('id');
        $result = Mage::getModel('brand/brand')->load($id)->delete();
        if($result){
            echo "<script>alert('insertion successfully')</script>";
            $this->setRedirect("brand/index/list");
        }
    }

    public function deleteAllAction(){}
}