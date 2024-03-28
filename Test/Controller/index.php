<?php

class Test_Controller_Index extends Core_Controller_Front_Action{
    protected $_allowedActions = ['show'];
    public function showAction(){
        $layout = $this->getLayout();
        $child = $layout->getChild('content');
        $productForm = $layout->createBlock('Test/form');//phtml ma state folder ma from.phtml muka je
        $child->addChild('form', $productForm);
        $layout->toHtml();
    }
    
}