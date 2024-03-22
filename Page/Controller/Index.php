<?php

class Page_Controller_Index extends Core_Controller_Front_Action
{
    public function indexAction()
    {
        $layout = $this->getLayout(); //core_block_layout
        $this->setFormCss('style1111');

        $banner = $layout->createBlock('page/banner')
            ->setTemplate('banner/banner.phtml');
        // Mage::getImagePath("banner/abc.jpg");
        $layout->getChild('content')
            ->addChild('banner', $banner);
        $layout->toHtml();
    }
    public function saveAction()
    {
        echo "Save Page";
    }
    public function listAction()
    {
        echo "List Page";
    }
}









