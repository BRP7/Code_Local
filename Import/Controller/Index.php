<?php
class Import_Controller_Index extends Core_Controller_Front_Action{
    public function importAction(){
        $this->setFormCss("form");
        $layout = $this->getLayout();
        $child = $layout->getChild('content');
        $productForm = $layout->createBlock('import/import');
        $child->addChild('form', $productForm);
        $layout->toHtml();
    }

    public function saveAction(){
       $data = $this->getRequest()->getParams('import');
       $fileName = $data['file'];
       Mage::getModel('import/import')->readCsv($fileName);
          $this->setRedirect('import/index/import');
    }
    public function uploadAction(){
        $type = $this->getRequest()->getParams('type');
        Mage::getModel('import/import')->uploadCsv($type);
    }
}