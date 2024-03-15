<?php

class Page_Controller_Index extends Core_Controller_Front_Action
{
    public function indexAction()
    {
        $layout = $this->getLayout(); //core_block_layout
        // $layout->getChild('head');
        // echo "<pre>";
        // $layout->getChild('head');
        // $layout->getChild('head')->addCss('css/navigation.css');
        // $layout->getChild('head')->addCss('css/page.css');

        $banner = $layout->createBlock('core/template')
                    ->setTemplate('banner/banner.phtml');
                    Mage::getImagePath("banner/abc.jpg");
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









