<?php

class Turnto_Mobile_Helper_Data extends Mage_Core_Helper_Data
{
    public function getStaticHostWithoutProtocol() {
        return $this->removeHttp(Mage::getStoreConfig('turnto_admin/general/static_url'));
    }

    public function getHostWithoutProtocol() {
        return $this->removeHttp(Mage::getStoreConfig('turnto_admin/general/url'));
    }

    function removeHttp($url) {
        $disallowed = array('http://', 'https://');
        foreach($disallowed as $d) {
            if(strpos($url, $d) === 0) {
                return str_replace($d, '', $url);
            }
        }
        return $url;
    }
}
