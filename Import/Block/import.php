<?php

class Import_Block_Import extends Core_Block_Template{

public function __construct(){
    $this->setTemplate('admin/import.phtml');
}
    // public function getBrand(){
    //     return Mage::getModel("brand/brand")->load($this->getRequest()->getParams("id",0));
    // }

    public function getPendingImportList()
    {
        return Mage::getModel('import/import')
            ->getCollection()
            ->addFieldToFilter('status', 0)
            ->addGroupBy('type')
            ->addCount('json_data', 'pending_import')
            ->getData();
    }
}