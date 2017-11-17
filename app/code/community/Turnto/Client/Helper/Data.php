<?php

class Turnto_Client_Helper_Data extends Mage_Core_Helper_Data
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

    function getSku($product = null)
    {
        if (!$product) {
            $product = $this->getProduct();
        }
        $sku = null;
        $parentIds = Mage::getModel('catalog/product_type_configurable')->getParentIdsByChild($product->getId());
        if (isset($parentIds[0]) && intval(Mage::getStoreConfig('turnto_admin/general/use_child_sku')) != 1) {
            $parent = Mage::getModel('catalog/product')->load($parentIds[0]);
            $sku = $this->escapeHtml($parent->getSku());
        } else if (intval(Mage::getStoreConfig('turnto_admin/general/use_child_sku')) == 1 && $product->isConfigurable()) {
            // get a random child of the configurable product
            $childProducts = Mage::getModel('catalog/product_type_configurable')
                ->getUsedProducts(null,$product);
            $sku = $childProducts[0]->getSku();
        } else {
            $product = Mage::getModel('catalog/product')->load($product->getId());
            $sku = $this->escapeHtml($product->getSku());
        }

        return $sku;
    }

    function getSkuAndVariantSkusAsJSArray($product = null) {
        if (!$product) {
            $product = $this->getProduct();
        }

        $parentIds = Mage::getModel('catalog/product_type_configurable')->getParentIdsByChild($product->getId());
        if (isset($parentIds[0])) {
            $parent = Mage::getModel('catalog/product')->load($parentIds[0]);
            $product = $parent;
        }

        $skuList = [$product->getSku()];

        if (intval(Mage::getStoreConfig('turnto_admin/general/use_child_sku')) == 1 && $product->isConfigurable()) {
            $childProducts = Mage::getModel('catalog/product_type_configurable')
                ->getUsedProducts(null, $product);

            foreach ($childProducts as $child) {
                array_push($skuList, $child->getSku());
            }
        }

        return '["' . join('","', $skuList) . '"]';
    }

    function loadFile($url)
    {
        $ch = curl_init();

        // Set query data here with the URL
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //todo: add config to system config to adjust timeout
        curl_setopt($ch, CURLOPT_TIMEOUT, '4');
        $content = trim(curl_exec($ch));
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http_status == 200) {
            return $content;
        } else {
            return "";
        }
    }

    public function getProduct()
    {
        return Mage::registry('current_product');
    }

    /**
     * Converts the version to the path string.  For instance, version 4.3 becomes 4_3.
     *
     * @return string
     */
    public function getVersionForPath() {
        $version = Mage::getStoreConfig('turnto_admin/general/version');
        $explodedVersion = explode('.', $version, 2);
        return $explodedVersion[0] . '_' . $explodedVersion[1];
    }
}
