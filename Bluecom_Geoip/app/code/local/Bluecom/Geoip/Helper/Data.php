<?php

class Bluecom_Geoip_Helper_Data extends Mage_Core_Helper_Abstract {

    protected $_geoLookupMethod;

    protected $_geoInstance;

    protected $_geoLocation;

    protected $_methods = array(
        'GeoIP' => 'country',
        'GeoIPCity' => 'city',
        'GeoLiteCity' => 'city',
    );

    /**
     * Get GeoIP object instance
     *
     * @param null|string $filename true: auto; no .dat
     * @param null|string $method null: auto
     * @param boolean $reinit force re-initialization
     * @return Net_GeoIP
     */
    public function getGeoInstance($filename = null, $method = null, $reinit = false)
    {
        if ($this->_geoInstance && !$reinit) {
            return $this->_geoInstance;
        }

        $geoDir = Mage::getBaseDir('var').'/geoip/';
        if (is_null($filename)) {
            $files = @glob($geoDir.'*.dat');
            if (sizeof($files)!=1) {
                Mage::throwException($this->__('There should be exactly 1 GeoIP dat file in var/geoip (GeoIP.dat, GeoIPCity.dat or GeoLiteCity.dat'));
            }
            $file = $files[0];
            $filename = str_replace(array($geoDir, '.dat'), '', $file);
        } else {
            $file = $geoDir.$filename.'.dat';
        }
        if (is_null($method)) {
            if (empty($this->_methods[$filename])) {
                Mage::throwException($this->__('Unknown method for file %s, and is not specified explicitly', $filename));
            }
            $method = $this->_methods[$filename];
        }
        $this->_geoLookupMethod = $method;
        $this->_geoInstance = Net_GeoIP::getInstance($file, Net_GeoIP::MEMORY_CACHE);
        $this->_geoLocation = null;

        return $this->_geoInstance;
    }

    /**
     * Get geo location for client IP
     *
     * Possible location fields:
     * - countryCode: US
     * - countryName: United States
     * - region: OR
     * - city: Portland
     * - postalCode: can be empty for city lookup as well
     * - latitude
     * - longitude
     * - areaCode: 503 (phone number code)
     * - dmaCode
     * - countryCode3: USA
     *
     * @param  boolean $asVarienObject
     * @param  null|string $ip
     * @return Net_GeoIP_Location|Varien_Object
     */
    public function getGeoLocation($asVarienObject = false, $ip = null)
    {
        if (!$this->_geoLocation || !is_null($ip)) {
            if (is_null($ip)) {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            $geoip = $this->getGeoInstance();

            switch ($this->_geoLookupMethod) {
                case 'country':
                    $loc = new Net_GeoIP_Location();
                    $loc->countryCode = $geoip->lookupCountryCode($ip);
                    $loc->countryName = $geoip->lookupCountryName($ip);
                    $loc->countryContinent = $geoip->lookupCountryContinent($loc->countryCode);
                    break;
                case 'region':
                    $loc = new Net_GeoIP_Location();
                    list($loc->countryCode, $loc->region) = $geoip->lookupRegion($ip);
                    $loc->countryName = $geoip->lookupCountryName($ip);
                    break;
                case 'city':
                    $loc = $geoip->lookupLocation($ip);
                    break;
                default:
                    Mage::throwException($this->__('Unknown method: %s', $this->_geoLookupMethod));
            }
            $this->_geoLocation = $loc;
        }
        return $asVarienObject ? new Varien_Object((array)$this->_geoLocation) : $this->_geoLocation;
    }
}