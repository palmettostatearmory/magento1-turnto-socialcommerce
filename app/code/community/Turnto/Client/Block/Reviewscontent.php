<?php

class Turnto_Client_Block_Reviewscontent extends Mage_Core_Block_Template
{
    const TURNTO_REVIEWS_STATIC_CACHE_TAG = 'TURNTO_REVIEWS_STATIC_CACHE_TAG';
    const TURNTO_REVIEW_STATIC_CACHE_KEY = 'TURNTO_REVIEW_STATIC_CACHE_KEY';
    const TURNTO_STATIC_EMBED = 'staticEmbed';
    const TURNTO_DYNAMIC_EMBED = 'dynamicEmbed';

    public function getCacheKey()
    {
        $helper = Mage::helper('turnto_client_helper/data');
        return $this::TURNTO_REVIEW_STATIC_CACHE_KEY . $helper->getProduct()->getId();
    }

    public function getCacheLifetime()
    {
        return Mage::getStoreConfig('turnto_admin/general/static_cache_time') ? intval(Mage::getStoreConfig('turnto_admin/general/static_cache_time')) : 900;
    }

    public function getCacheTags()
    {
        return array(
            $this::TURNTO_REVIEWS_STATIC_CACHE_TAG,
            Mage_Catalog_Model_Product::CACHE_TAG,
            Mage::app()->getStore()->getId(),
            (int)Mage::app()->getStore()->isCurrentlySecure(),
            Mage::getDesign()->getPackageName(),
            Mage::getDesign()->getTheme('template'),
            Mage::getStoreConfig('turnto_admin/reviews/reviews_setup_type')
        );
    } 

    public function getReviewsHtml()
    {
        $setupType = Mage::getStoreConfig('turnto_admin/reviews/reviews_setup_type');
        if ($setupType == $this::TURNTO_DYNAMIC_EMBED) {
            return '<div id="TurnToReviewsContent"></div>';
        } else if ($setupType == $this::TURNTO_STATIC_EMBED) {
            $helper = Mage::helper('turnto_client_helper/data');
            $sku = $helper->getSku($this->getProduct());
            $reviewsUrl = Mage::getStoreConfig('turnto_admin/general/static_url') . '/sitedata/' . Mage::getStoreConfig('turnto_admin/general/site_key') . '/v' . $helper->getVersionForPath() . '/' . urlencode($sku) . '/d/catitemreviewshtml';
            return $helper->loadFile($reviewsUrl);
        }

        return '';
    }
}
