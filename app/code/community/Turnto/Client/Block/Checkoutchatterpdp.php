<?php

class Turnto_Client_Block_Checkoutchatterpdp extends Mage_Core_Block_Template
{
    const TURNTO_CC_PDP_CACHE_TAG = 'TURNTO_CC_PDP_CACHE_TAG';
    const TURNTO_CC_PDP_CACHE_KEY = 'TURNTO_CC_PDP_CACHE_KEY';

    public function __construct()
    {
        // cache by store, http(s), package, theme
        $this->addData(array(
            // defaults to 15 minutes
            'cache_lifetime' => Mage::getStoreConfig('turnto_admin/general/cc_display_cache_time') ? intval(Mage::getStoreConfig('turnto_admin/general/cc_display_cache_time')) : 900,
            'cache_tags' => array(
                $this::TURNTO_CC_PDP_CACHE_TAG,
                Mage_Catalog_Model_Product::CACHE_TAG,
                Mage::app()->getStore()->getId(),
                (int)Mage::app()->getStore()->isCurrentlySecure(),
                Mage::getDesign()->getPackageName(),
                Mage::getDesign()->getTheme('template')
            ),
            'cache_key' => $this::TURNTO_CC_PDP_CACHE_KEY . $this->getProduct()->getId()
        ));
    }

    public function getProduct()
    {
        return Mage::registry('current_product');
    }
}
