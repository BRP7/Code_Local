<?php

class Catalog_Block_Admin_Product_Allproduct  extends Core_Block_Template {
    public function __construct() { 
            $this->setTemplate("catalog/admin/product/allProducts.phtml"); //design
}

public function getProductCollection(){
    return Mage::getModel('catalog/product')->getCollection();
}
}

?>