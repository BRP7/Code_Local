<?php
class Core_Block_Layout extends Core_Block_Template
{
    public function __construct()
    {
        $this->setTemplate('core/1column.phtml'); //template set karayu khali template variable ma set krine ape value
        $this->prepareChildren();
    }
    public function prepareChildren()
    {
        $header = $this->createBlock('page/header'); //page_block_header no object banaine apse
        $this->addChild('header', $header);

        $content = $this->createBlock('page/content');
        $this->addChild('content', $content);

        $footer = $this->createBlock('page/footer');
        $this->addChild('footer', $footer);

        $head = $this->createBlock('page/head');
        $this->addChild('head', $head);

        $messages = $this->createBlock('core/template');
        $messages->setTemplate('core/messages.phtml');
        $this->addChild('messages', $messages);
    }
    public function createBlock($className)
    {
        return Mage::getBlock($className);
    }

}