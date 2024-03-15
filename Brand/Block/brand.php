<?php

class Brand_Block_Brand extends Core_Block_Template{


    public function getBrand(){
        return Mage::getModel("brand/brand")->load($this->getRequest()->getParams("id",0));
    }
}