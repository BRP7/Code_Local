<?php

class Page_Block_Banner extends Core_Block_Template
{
    public function getImageList()
    {
        $productCollection = Mage::getModel("banner/banner")->getCollection();
        $imageList = [];
        foreach ($productCollection->getData() as $value) {
            $imageList[] = $value->getBannerImage();
        }
        return $imageList;
    }
}
?>