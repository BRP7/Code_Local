<?php

class Sales_Model_Quote_Item extends Core_Model_Abstract
{
    protected $_item = null;

    public function init()
    {
        $this->_resourceClass = 'Sales_Model_Resource_Quote_Item';
        $this->_collectionClass = 'Sales_Model_Resource_Collection_Quote_Item';
    }

    //Give Product Details Based on ProductId from that Item Record
    public function getProduct()
    {
        if (is_null($this->_item)) {
            $this->_item = Mage::getModel('catalog/product')->load($this->getProductId());
        }
        return $this->_item;
    }

    protected function _beforeSave()
    {
        if ($this->getProductId()) {
            $price = $this->getProduct()->getPrice();
            $this->addData('price', $price);
            $this->addData('row_total', $price * $this->getQty());
        } else {
        }
    }

    // add & update based on item id
    public function addItem(Sales_Model_Quote $quote, $request)
    {
        //condition for insert we don't get item id if record is new in post data array
        if (!array_key_exists('item_id', $request)) {
            
            //check if item record already exist in db
            $item = $this->getCollection()
                ->addFieldToFilter('product_id', $request['product_id'])
                ->addFieldToFilter('quote_id', $quote->getId())
                ->getFirstItem()
            ;

            //if item exist before then qty added in previous one
            if ($item) {
                $request['qty'] = $request['qty'] + $item->getQty();
            }

            //dataset for sales_quote_item -> item id is autoIncrement for new record 
            $this->setData(
                [
                    'quote_id' => $quote->getId(),
                    'product_id' => $request['product_id'],
                    'qty' => $request['qty'],
                ]
            );

        } else {
            $item = $this->getCollection()
                ->addFieldToFilter('quote_id', $quote->getId())
                ->addFieldToFilter('item_id', $request['item_id'])
                ->addFieldToFilter('product_id', $request['product_id'])
                ->getFirstItem();
            $this->setData([
                'item_id' => $request['item_id'],
                'product_id' => $request['product_id'],
                'quote_id' => $quote->getId(),
                'qty' => $request['qty'],
            ]);

        }

        if ($item) {
            $this->setId($item->getId());
        }
        $this->save();

        return $this;


    }

    // public function editItem(Sales_Model_Quote $quote, $request)
    // {
    //     $item = $this->getCollection()
    //         ->addFieldToFilter('quote_id', $quote->getId())
    //         ->addFieldToFilter('item_id', $request['item_id'])
    //         ->addFieldToFilter('product_id', $request['product_id'])
    //         ->getFirstItem();
    //     if ($item) {
    //         $qty = $request['qty'];
    //     }
    //     $item->setData([
    //         'item_id' => $request['item_id'],
    //         'product_id' => $request['product_id'],
    //         'quote_id' => $quote->getId(),
    //         'qty' => $qty
    //     ]);

    //     if ($item) {
    //         $this->setId($item->getId());
    //     }
    //     // var_dump($item->_data());
    //     $this->save();
    //     return $this;
    // }


    public function removeItem($quoteId, $itemId)
    {
        //checking if item exist in db
        $item = $this->getCollection()
            ->addFieldToFilter('quote_id', $quoteId)
            ->addFieldToFilter('item_id', $itemId)
            ->getFirstItem();

        if ($item) {
            $this->setId($item->getId());
        }
        // print($this->getId());
        $this->delete();
    }
    // public function removeItem(Sales_Model_Quote $quote, $itemId)
    // {
    //     $item = $this->getCollection()
    //         ->addFieldToFilter('quote_id', $quote->getId())
    //         ->addFieldToFilter('item_id', $itemId)
    //         ->getFirstItem()
    //         ->delete();
    //     return $this;
    // }
}