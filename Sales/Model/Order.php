<?php

class Sales_Model_Order extends Core_Model_Abstract
{
    public function init()
    {
        $this->_resourceClass = 'Sales_Model_Resource_Order';
        $this->_collectionClass = 'Sales_Model_Resource_Collection_Order';
        // $this->_modelClass = 'sales/quote';
    }

    public function getPaymentAndShippingId($paymentId, $shippingId)
    {
        $this->addData('payment_id', $paymentId)
            ->addData('shipping_id', $shippingId)
            ->save();
    }

    public function getOrderItemCollection(sales_model_order $obj)
    {
        return Mage::getModel('sales/order_item')
            ->getCollection()
            ->addFieldToFilter('order_id', $obj->getOrderId());
    }
    public function getItemCollection()
    {
        // print_r($this->getId());
        return Mage::getModel('sales/order_item')->getCollection()
            ->addFieldToFilter('order_id', $this->getId())
            ->getFirstItem();
    }
   

    public function _beforeSave()
    {
        $orderNumber = rand(1000000, 9999999);

        $flag = True;
        while ($flag) {
            $existOrderNumber = Mage::getModel('sales/order')
                ->getCollection()
                ->addFieldToFilter('order_number', $orderNumber)
                ->getFirstItem();
            if (!$existOrderNumber) {
                $flag = False;
            }
            $orderNumber = rand(1000000, 9999999);
        }
        $this->addData('order_number', $orderNumber);
    }

    public function historySave($data)
    {
        $orderId = ['order_id' => $data['id']];
        $fromStatus = Mage::getModel('sales/order')->load($data['id']);
        $fromStatus = $fromStatus->getStatus();
        // print_r($fromStatus);
        // die;
        $hisData = Mage::getModel('sales/order_history')
            ->setData($orderId)
            ->addData('to_status', $data['status'])
            ->addData('action_by', $data['action'])
            ->addData('from_status', $fromStatus);
        //    print_r($hisData);die;
        $result = $hisData->save();
        if ($result) {
            echo '<script>alert("Data inserted successfully")</script>';
            // echo "<script>location.href='" . Mage::getBaseUrl() . 'admin/catalog_product/list' . "'</script>";
        }


    }

}