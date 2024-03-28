<?php

class Test_Block_Form extends Core_Block_Template{

public function __construct(){
    $this->setTemplate('state/from.phtml');
}

public function getParentData(){
    return Mage::getModel('test/parent')->getCollection()->getData();
}

public function getCHildData($id){
    return Mage::getModel('test/child')->getCollection()
    ->addFieldToFilter('state_id',$id)->getData();
}


}
