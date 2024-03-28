<?php

class CurrencyConverter_Block_Form extends Core_Block_Template{

public function getCurrency(){
    return Mage::getModel("Currencyconverter/Currencyconverter")->load($this->getRequest()->getParams("id",0));
}

public function productCollection(){

}
public function getCountryIdName()
    {
        $countrys = [];
        $countryCollection = Mage::getModel("currencyConverter/currencyConverter")->getCollection();
        foreach ($countryCollection->getData() as $country) {
            $countrys[$country->getCountryId()] = $country->getRate();
        }
        // print_r($countrys);
        return $countrys;
    }
    public function getCountrysNameById($mapping, $country)
    {
        $countryData = $country->getData();
        if (isset( $countryData['id'])) {
            return $mapping[$countryData['id']];
        }
    }

}
