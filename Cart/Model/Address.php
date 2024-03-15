<?php

class Cart_Model_Address extends Core_Model_Abstract{
    public function init(){
        $this->_resourceClass = 'Cart_Model_Resource_Address';
        $this->_collectionClass = 'Cart_Model_Resource_Collection_Address';
    }

    public function addAddress($request)
    {
        $addressId =  Mage::getSingleton('core/session')->get('address_id',0);
        if(!$addressId){
            $result = Mage::getModel('cart/address')->setdata($request)->save();
            Mage::getSingleton('core/session')->set('address_id',$this->getId());   
            if($result){
                echo "<script>alert('data inserted successfully!')</script>";
            }
        }else{
            Mage::getModel('cart/address')->setdata($request)
                                                ->addData($addressId)
                                                ->save(); 
    }
    }
    public function _beforeSave(){
        $customerId = Mage::getSingleton('core/session')->get('logged_in_customer_id');
        // $quoteId = Mage::getSingleton('core/session')->get('quote_id');
        $this->addData('customer_id',$customerId);
        // ->addData('quote_id',$quoteId);
    }

}
?>