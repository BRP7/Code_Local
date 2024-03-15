<?php
class Page_Block_Head extends Core_Block_Template
{
    protected $_css = []; //_css array ma bdhu css store thai jase
    protected $_js = []; //array ma store tahtu jase
    public function __construct()
    {
        $this->setTemplate('page/head.phtml');
    }

    public function addJs($file)
    {
        $this->_js[] = $file; //paramtetr ma pass kri hase tema sttore krse
        return $this;
    }
    public function addCss($file)
    {
        $this->_css[] = $file;
        //print_r($this->_css);
        return $this;
    }
    public function getJs()
    {
        return $this->_js;
    }
    public function getCss()
    {
        // print_r($this->_css);
        return $this->_css;
    }

    public function getCssUrl($_css)
    {

        return Mage::getBaseUrl('skin/css/' . $_css);
    }
    public function getJsUrl($_js)
    {
        return Mage::getBaseUrl('/skin/js/' . $_js);
    }
}