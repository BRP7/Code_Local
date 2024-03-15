<?php

class Sales_Model_Quote_Customer extends Core_Model_Abstract
{

    public function init()
    {
    $this->_resourceClass = 'Sales_Model_Resource_Quote_Customer';
    $this->_collectionClass = 'Sales_Model_Resource_Collection_Quote_Customer';
    // $this->_modelClass = 'sales/quote_customer';
    }

    public function checkoutItem($data){
        echo "Hello";
       print_r($data);
    }

    public function _beforeSave(){
        $customerId = Mage::getSingleton('core/session')->get('logged_in_customer_id');
        $quoteId = Mage::getSingleton('core/session')->get('quote_id');
        $this->addData('customer_id',$customerId)
        ->addData('quote_id',$quoteId);
    }
    // public function saveItem(Sales_Model_Quote $quote, $request)
    // {
    //     $insert = Mage::getModel('sales/quote_customer')->getCollection()
    //     ->addFieldToFilter('quote_id',$request['quote_id'])
    //     ->addFieldToFilter('customer_id',$request['customer_id'])
    //     ->getFirstItem();

    //     if (!$insert) {
    //         $result = Mage::getModel('sales/quote_customer')->setdata($request)->save();
    //         if($result){
    //             echo "<script>alert('data inserted successfully')</script>";
    //         }


    //     } else {
            
    //         // if ($item) {
    //         //     $qty = $request['qty'];
    //         //     // print_r($qty);
    //         // }
    //         $this->setData([
    //             // 'item_id' => $request['item_id'],
    //             'customer_id' => $request['customer_id'],
    //             'quote_id' => $quote->getId(),
    //             // 'qty' => $request['qty']
    //         ]);
    //         $this->save();
    //     }

    //     // if ($item) {
    //     //     $this->setId($item->getId());
    //     // }
    //     // $this->save();

    //     return $this;


    // }
    public function saveProduct($request)
    {
        $quoteCustomerId =  Mage::getSingleton('core/session')->get('quote_customer_id',0);
        if(!$quoteCustomerId){
            $result = Mage::getModel('sales/quote_customer')->setdata($request)->save();
            Mage::getSingleton('core/session')->set('quote_customer_id',$this->getId());
            if($result){
                echo "<script>alert('data inserted successfully!')</script>";
            }
        }else{
            echo 123;
            Mage::getModel('sales/quote_customer')->setdata($request)
                                                ->addData($quoteCustomerId)
                                                ->save(); 
        }
    }

}