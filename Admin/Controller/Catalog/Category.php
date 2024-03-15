<?php
class Admin_Controller_Catalog_Category extends Core_Controller_Admin_Action
{


    // public function setFormCss()
    // {
    //     $layout = $this->getLayout();
    //     $layout->getChild('head')
    //         ->addCss('category.css');
    // }
    public function formAction()
    {
        $this->setFormCss("from");
        $layout = $this->getLayout();
        $child = $layout->getChild('content'); 
        $productForm = $layout->createBlock('catalog/admin_category_form');
        $child->addChild('form', $productForm);
        $layout->toHtml();
    }


    public function saveAction()
    {
        $data = $this->getRequest()->getparams("catalog_category");
        Mage::getModel("catalog/category")
            ->setData($data)
            ->save();
    }
    public function deleteAction()
    {
        $id = $this->getRequest()->getparams("id");
        $product = Mage::getModel('catalog/category') ->load($id);
        $result = $product->delete();
        if ($result){
            echo "<script>alert('data deleted sucessfully')</script>";
            echo "<script>location.href='" . Mage::getBaseUrl() . 'admin/catalog_product/list' . "'</script>";
        }
    }
    public function listAction()
    {
        $layout = $this->getLayout();
        $child = $layout->getchild('content');
        $productForm = $layout->createBlock('catalog/admin_category_list');
        $child->addchild('list', $productForm);
        $layout->toHtml();
    }

    public function view(){
        
    }


}

?>