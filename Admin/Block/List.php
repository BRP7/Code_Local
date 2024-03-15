<?php

class Admin_Block_List extends Core_Block_Template{
    public function __construct(){
         $this->setTemplate("admin/list.phtml");
    }
    function showList()
    {
        $findQues = Mage::getModel('core/request')->getQueryData('id');;
        $productCollection = Mage::getModel('catalog/product')->getCollection()
            ->addFieldToFilter("category_id", $findQues);
            return $productCollection;   
    }
}