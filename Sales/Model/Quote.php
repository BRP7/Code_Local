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
        $quoteId = Mage::getSingleton("core/session")->get("quote_id");
        // var_dump($quoteId);
        if (!empty ($quoteId)) {
            $this->load($quoteId);//sales_quote
        }
        if (!$this->getId()) {
            $quote = Mage::getModel("sales/quote")
                ->setData(["tax_percent" => 8, "grand_total" => 0])
                ->save();
            Mage::getSingleton("core/session")->set("quote_id", $quote->getId());
            $quoteId = $quote->getId();
            $this->load($quoteId);
        }
        return $this;

    }

    public function getItemCollection()
    {
        // $this->initQuote();
        // var_dump($this->getId());
        return Mage::getModel('sales/quote_item')->getCollection()
            ->addFieldToFilter('quote_id', $this->getId());
    }

    protected function _beforeSave()
    {
        $grandTotal = 0;
        foreach ($this->getItemCollection()->getData() as $_item) {
            $grandTotal += $_item->getRowTotal();
        }
        if ($this->getTaxPercent()) {
            $tax = round($grandTotal / $this->getTaxPercent(), 2);
            $grandTotal = $grandTotal + $tax;
        }
        $this->addData('grand_total', $grandTotal);

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
            ->addFieldToFilter('quote_id', Mage::getSingleton('core/session')
                ->get('quote_id'))
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

        if ($quoteCustomerId) {
            $addrerssModel->addData('quote_customer_id', $quoteCustomerId)
                ->save();
        } else {
            $addrerssModel->save();
            $quoteCustomerId = $addrerssModel->getId();
            Mage::getSingleton('core/session')->set('quote_customer_id', $quoteCustomerId);
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
        print_r($data);
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



    public function convertToOrder()
    {
        $this->initQuote();
        if ($this->getId()) {
            $order = Mage::getSingleton("sales/order")
                ->setData($this->getData())
                ->removeData('quote_id')
                // ->removeData('order_id')
                ->save();
            foreach ($this->getQuoteItemCollection() as $_item) {
                Mage::getModel("sales/order_item")
                    ->setData($_item->getData())
                    ->removeData('quote_id')
                    ->removeData('item_id')
                    ->removeData('customer_id')
                    ->addData('order_id', $order->getId())
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
        }
        Mage::getSingleton('sales/order')->getPaymentAndShippingId($payment->getId(),$shipping->getId());
        $this->addData('order_id', $order->getId())
            ->addData('payment_id', $payment->getId())
            ->addData('shipping_id', $shipping->getId())
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




}

