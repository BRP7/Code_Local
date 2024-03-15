<?php
class Admin_Controller_Catalog_Product extends Core_Controller_Admin_Action
{
    protected $_allowedActions = ['form'];


    public function formAction()
    {
        $this->setFormCss("form");
        $layout = $this->getLayout();
        $child = $layout->getChild('content');
        $productForm = $layout->createBlock('catalog/admin_product_form');//constructor
        $child->addChild('form', $productForm);
        $layout->toHtml();
    }


    public function saveAction()
    {
        $data = $this->getRequest()->getparams("catalog_product");
        $product = Mage::getModel('catalog/product')
                    ->setData($data);
        $result = $product->save();
        if ($data['product_id']) {
            if ($result) {
                echo '<script>alert("Data updated successfully")</script>';
                echo "<script>location.href='" . Mage::getBaseUrl() . 'admin/catalog_product/list' . "'</script>";
            }
        } else {
            echo '<script>alert("Data inserted successfully")</script>';
            echo "<script>location.href='" . Mage::getBaseUrl() . 'admin/catalog_product/list' . "'</script>";
        }

    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getparams("id");
        $product = Mage::getModel("catalog/product")->load($id);
        $result = $product->delete();
        if ($result) {
            echo "<script>alert('data deleted sucessfully')</script>";
            echo "<script>location.href='" . Mage::getBaseUrl() . 'admin/catalog_product/list' . "'</script>";
        }

    }

    public function listAction()
    {
        $layout = $this->getLayout();
        $child = $layout->getchild('content'); //core_block_layout
        $productForm = $layout->createBlock('catalog/admin_product_list');
        $child->addchild('list', $productForm);
        $layout->toHtml();

    }

    public function view()
    {

    }
}










