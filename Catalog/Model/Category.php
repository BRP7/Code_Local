<?php
class Catalog_Model_Category extends Core_Model_Abstract
{
    public function init()
    {
        $this->_resourceClass = 'Catalog_Model_Resource_Category';
        $this->_collectionClass = 'Catalog_Model_Resource_Collection_Category';
        // $this->_modelClass = 'catalog/category';
    }
    // public function getArrayOfIDs(){
    //     //array -> block/category->id to name mapping getNameFromId define
    //     //product/model->getNameFromId ->call getModel(catalog/category) obj
    // }                     
    public function getCategoryIdName()
    {
        $categorys = [];
        $categoryCollection = $this->getCollection();
        foreach ($categoryCollection->getData() as $category) {
            $categorys[$category->getCategoryId()] = $category->getCategoryName();
        }
        return $categorys;
    }
    public function getCategoryNameById($mapping, $product)
    {
        $productData = $product->getData();
        // print_r($productData);
        if (isset($productData['category_id'])) {
            return $mapping[$productData['category_id']];
        }
    }

    public function getStatus()
    {
        $mapping = [
            1 => "E",
            0 => "D"
        ];
        // var_dump($mapping);
        // echo"<pre>";
        // var_dump($this->_data);
        // var_dump($this->_data['status']);
        // print_r($this->_data['status']);
        return isset($this->_data['status'])?
           $mapping[$this->_data['status']]:"";
   
    }
    //public

}
?>