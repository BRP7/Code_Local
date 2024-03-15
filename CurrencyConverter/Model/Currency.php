<?php

class CurrencyConverter_Model_Currency extends Core_Model_Abstract{

    public function init(){
        $this->_resourceClass = "Currencyconverter_Model_Resource_Currency";
        $this->_collectionClass="Currencyconverter_Model_Resource_Collection_Currency";
    }

    public function getCurrencyValue($id){
      
        $currencyValue = Mage::getModel('CurrencyConverter/currency')->getCollection()
            ->addFieldToFilter('id',$id);
        foreach ($currencyValue->getData() as $value) {
            return $value->getRate();
        }
    }

    public function getCountryIdName()
    {
        $countrys = [];
        $countryCollection = $this->getCollection();
        foreach ($countryCollection->getData() as $country) {
            $countrys[$country->getId()] = $country->getName();
        }
        // print_r($countrys);
        return $countrys;
    }
    public function getCountrysNameById($mapping, $country)
    {
        $countryData = $country->getData();
        // print_r($countryData);
        if (isset( $countryData['id'])) {
            return $mapping[$countryData['id']];
        }
    }

    public function getCurrencyValueName($id){
      
        $currencyValue = Mage::getModel('currency/currency')->getCollection()
            ->addFieldToFilter('id',$id);
        foreach ($currencyValue->getData() as $value) {
            return $value->getCountry();
        }
    }




    // function convertCurrency($data) {
    
    //     if ($data['amount'] !== null) {
            
    //         $currencyCountry = $this->getCurrencyValue($data['currency_country']);
    //         $country = $this->getCurrencyValue($data['country']);

    //         $convertedAmount = $data['amount'] * ($currencyCountry / $country);
    //         return $convertedAmount;
    //     } else {
    //         return null;
    //     }
    // }




    
}