<?php

class Catalog_Controller_Product extends Core_Controller_Front_Action{

    public function viewAction()
    {
        $this->setFormCss("view");
        $layout = $this->getLayout();
        $child = $layout->getchild('content'); //core_block_layout
        $productForm = $layout->createBlock('catalog/admin_product_list');
        $child->addChild('list',$productForm);
        $layout->toHtml();
    }
    public function allAction()
    {
        $this->setFormCss("view121");
        $layout = $this->getLayout();
        $child = $layout->getchild('content'); //core_block_layout
        $productForm = $layout->createBlock('catalog/admin_product_allproduct');
        $child->addChild('list',$productForm);
        $layout->toHtml();
    }
  
}