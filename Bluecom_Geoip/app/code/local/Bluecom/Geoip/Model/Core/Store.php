<?php

class Bluecom_Geoip_Model_Core_Store extends Mage_Core_Model_Store {

    public function getDefaultCurrencyCode()
    {
        $result = $this->getConfig(Mage_Directory_Model_Currency::XML_PATH_CURRENCY_DEFAULT);
        $countryCode = Mage::getStoreConfig('general/country/default');
        $geoCountryCode = null;
        $geoContinentCode = null;

        try {
            if(!$countryCode) {
                Mage::helper('bluecom_geoip')->getGeoInstance('GeoIP');
                $geoIp = Mage::helper('bluecom_geoip')->getGeoLocation(true);
                $geoCountryCode = $geoIp->getData('countryCode');
                Mage::getSingleton('core/session')->setCountryCode($geoCountryCode);
            } else {
                $geoCountryCode = $countryCode;
            }
        } catch (Exception $e) {

        }

        switch ($geoCountryCode) {
            case "DE":
                $result = "EUR";
                break;
            case "FR":
                $result = "AUD";
                break;
            default:
                $result = "USD";
                break;
        }
        return $result;
    }

}