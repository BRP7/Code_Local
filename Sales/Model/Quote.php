<?php

class Sales_Model_Quote extends Core_Model_Abstract
{
    public function init()
    {
        $this->_resourceClass = 'Sales_Model_Resource_Quote';
        $this->_collectionClass = 'Sales_Model_Resource_Collection_Quote';
        // $this->_modelClass = 'sales/quote';
    }

    public function initQuote()
    {
        $quoteId = Mage::getSingleton('core/session')->get('quote_id');
        $customerId = Mage::getSingleton('core/session')->get('logged_in_customer_id');
        if (!$quoteId) {
            $quote = Mage::getModel('sales/quote')
                ->setData([
                    'tax_percent' => 8,
                    'grand_total' => 0,
                ]);
            if (!is_null($this->getQuoteCollection())) {
                // print_r($this->getQuoteCollection());
                $quoteId = $this->getQuoteCollection()->getQuoteId();
                $quote->addData('quote_id', $quoteId);
            }
            $quote->save();
            Mage::getSingleton('core/session')
                ->set('quote_id', $quote->getId());
            $quoteId = $quote->getId();
            $this->load($quoteId);
        } else {
            if ($customerId) {
                $quoteModel = Mage::getModel('sales/quote')->load($quoteId);
                $quoteModel->addData('customer_id', $customerId)->save();
                $quoteId = $quoteModel->getId();
            }
            $this->load($quoteId);
        }
        return $this;
    }
    public function getItemCollection()
    {
        // print_r($this->getId());
        return Mage::getModel('sales/quote_item')->getCollection()
            ->addFieldToFilter('quote_id', $this->getId())
            ->getData();
    }
    public function addProduct($request)
    {
        $this->initQuote();
        if ($this->getId()) {
            Mage::getSingleton('sales/quote_item')
                ->addItem($this, $request);//product_id,qty for add
        }
        $this->save();
        return $this;
    }
    protected function _beforeSave()
    {
        $grandTotal = 0;
        foreach ($this->getItemCollection() as $_item) {
            // var_dump($_item);

            $grandTotal += $_item->getRowTotal();
        }
        if ($this->getTaxPercent()) {
            $tax = round($grandTotal / $this->getTaxPercent(), 2);
            $grandTotal = $grandTotal + $tax;
        }
        $this->addData('grand_total', $grandTotal);
    }

    public function removeProduct($request)
    {
        // $quoteId = Mage::getSingleton("core/session")->get("quote_id");
        $quoteId = $request['quote_id'];
        //  print_r($quoteId);  
        $this->initQuote();
        if ($quoteId) {
            Mage::getSingleton('sales/quote_item')
                ->removeItem($quoteId, $request['item_id']);
        }

        $this->save();
        return $this;
    }

    public function getAddressCollection()
    {
        return Mage::getSingleton('sales/quote_customer')
            ->getCollection()
            ->addFieldToFilter('quote_id', Mage::getSingleton('core/session')->get('quote_id'))
            ->getFirstItem();
    }
    public function addAddress($data)
    {
        $quoteCustomerId = 0;
        $addrerssCollection = $this->getAddressCollection();
        if ($addrerssCollection) {
            $quoteCustomerId = $addrerssCollection->getQuoteCustomerId();
        }
        $addrerssModel = Mage::getSingleton('sales/quote_customer');
        $addrerssModel->setData($data);

        if ($quoteCustomerId) { //update
            $addrerssModel->addData('quote_customer_id', $quoteCustomerId)
                ->save();
        } else {  //insert
            $addrerssModel->save();
            $quoteCustomerId = $addrerssModel->getId();
            Mage::getSingleton('core/session')->set('quote_customer_id', $quoteCustomerId);//not
        }
    }

    public function getShippingCollection()
    {
        return Mage::getModel('sales/quote_shipping')
            ->getCollection()
            ->addFieldToFilter('quote_id', Mage::getSingleton('core/session')
                ->get('quote_id'))
            ->getFirstItem();
    }
    public function addShipping($data)
    {
        // print_r($data);
        $shippingId = 0;
        $shippingCollection = $this->getShippingCollection();

        if ($shippingCollection) {
            $shippingId = $shippingCollection->getShippingId();
        }
        $shippingModel = Mage::getSingleton('sales/quote_shipping');
        $shippingModel->setData($data);
        if ($shippingId) {
            $shippingModel->addData('shipping_id', $shippingId)->save();
        } else {
            $shippingModel->save();
        }
    }
    public function getPaymentCollection()
    {
        // print_r(Mage::getSingleton('core/session')
        // ->get('quote_id'));
        // echo "<br>";
        $res = Mage::getModel('sales/quote_payment')
            ->getCollection()
            ->addFieldToFilter('quote_id', Mage::getSingleton('core/session')->get('quote_id'))
            ->getFirstItem();
        return $res;
        // die;
        // ->getFirstItem();
    }


    public function addPayment($data)
    {
        $paymentId = 0;
        $paymentCollection = $this->getPaymentCollection();
        if ($paymentCollection) {
            $paymentId = $paymentCollection->getPaymentId();
        }
        $paymentModel = Mage::getSingleton('sales/quote_payment');
        $paymentModel->setData($data);
        if ($paymentId) {
            $paymentModel->addData('payment_id', $paymentId)->save();
        } else {
            $paymentModel->save();
        }
    }
    public function getQuoteCollection()
    {
        $customerId = Mage::getSingleton('core/session')->get('logged_in_customer_id');
        if ($customerId) {
            return Mage::getSingleton('sales/quote')
                ->getCollection()
                ->addFieldToFilter('customer_id', $customerId)
                ->addFieldToFilter('order_id', 0)
                ->getFirstItem();
        } else {
            return null;
        }
    }

    public function getOrderCollection()
    {
        return Mage::getModel('sales/order')
            ->getCollection();
    }


    public function convertToOrder()
    {
        $this->initQuote();

        if ($this->getId()) {
            $order = Mage::getSingleton("sales/order")
                ->setData($this->getData())
                ->removeData('quote_id')
                ->removeData('order_id')
                ->save();
            foreach ($this->getQuoteItemCollection() as $_item) {
                Mage::getModel("sales/order_item")
                    ->setData($_item->getData())
                    ->removeData('quote_id')
                    ->removeData('item_id')
                    ->removeData('customer_id')
                    ->addData('order_id', $order->getId())
                    // print_r($_item->getProduct()->getName());
                    // die;
                    ->addData('product_name',$_item->getProduct()->getName())
                    ->addData('product_color',$_item->getProduct()->getColor())
                    ->save();
            }
            Mage::getModel("sales/order_customer")
                ->setData($this->getQuoteCustomerCollection()->getData())
                ->removeData('quote_id')
                ->removeData('quote_customer_id')
                ->addData('order_id', $order->getId())
                ->save();

            $payment = Mage::getModel("sales/order_payment")
                ->setData($this->getQuotePaymentCollection()->getData())
                ->removeData('quote_id')
                ->removeData('payment_id')
                ->addData('order_id', $order->getId())
                ->save();

            $shipping = Mage::getModel("sales/order_shipping")
                ->setData($this->getQuoteShippingCollection()->getData())
                ->removeData('quote_id')
                ->removeData('shipping_id')
                ->addData('order_id', $order->getId())
                ->save();
            $this->getProductStock();
        }
        Mage::getSingleton('sales/order')->getPaymentAndShippingId($payment->getId(), $shipping->getId());
        $this->addData('order_id', $order->getId())
            ->addData('payment_id', $payment->getId())
            ->addData('shipping_id', $shipping->getId())
            // ->addData('is_order', 1)
            ->save();

    }



    public function getQuoteItemCollection()
    {
        return Mage::getSingleton('sales/quote_item')
            ->getCollection()
            ->addFieldToFilter('quote_id', Mage::getSingleton('core/session')
                ->get('quote_id'))
            ->getData();
    }
    public function getQuoteCustomerCollection()
    {
        return Mage::getSingleton('sales/quote_customer')
            ->getCollection()
            ->addFieldToFilter('quote_id', Mage::getSingleton('core/session')
                ->get('quote_id'))
            ->getFirstItem();
    }
    public function getQuotePaymentCollection()
    {
        return Mage::getSingleton('sales/quote_payment')
            ->getCollection()
            ->addFieldToFilter('quote_id', Mage::getSingleton('core/session')
                ->get('quote_id'))
            ->getFirstItem();
    }
    public function getQuoteShippingCollection()
    {
        return Mage::getSingleton('sales/quote_shipping')
            ->getCollection()
            ->addFieldToFilter('quote_id', Mage::getSingleton('core/session')
                ->get('quote_id'))
            ->getFirstItem();
    }

    public function getProductStock()
    {
        foreach ($this->getItemCollection() as $_item) {
            $data = Mage::getModel('catalog/product')
                ->getCollection()
                ->addFieldToFilter('product_id', $_item->getProductId());
            foreach ($data->getData() as $product) {
                $stock = $product->getStock() - $_item->getQty();
                Mage::getModel('catalog/product')
                    ->setData($product->getData())
                    ->addData('stock', $stock)
                    ->save();
            }
        }
        return $this;
    }

    public function getQuoteCollectionByQuoteId($id)
    {
        return Mage::getModel('sales/quote')
            ->getCollection()
            ->addFieldToFilter('quote_id', $id)
        ;
        // ->addFieldToFilter('order_id',$obj->getOrderId());
    }

    public function checkQty(){
        $quoteId = Mage::getSingleton('core/session')->get('quote_id');
        $quoteData = Mage::getSingleton('sales/quote_item')->getCollection()->addFieldToFilter('quote_id',$quoteId);
        $flag = 0;
        if($quoteData){
            foreach($quoteData->getData() as $_item){
                $itemQty = $_item->getQty();
                $stock = $_item->getProduct()->getStock();
                if($stock<=$itemQty){
                $flag = $_item->getItemId();
              }
            }
       }
       return $flag;
       
      
    }


}

