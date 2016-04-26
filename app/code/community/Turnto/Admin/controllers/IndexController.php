<?php

class Turnto_Admin_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        header('Content-type: text/plain; charset=utf-8');
        try {
            $resource = Mage::getSingleton('core/resource');
            $readConnection = $resource->getConnection('core_read');
            $params = $this->getRequest()->getParams();

            $storeId = 1;
            if (isset($params['storeId'])) {
                $storeId = $params['storeId'];
            }

            $websiteId = 1;
            if (isset($params['websiteId'])) {
                $websiteId = $params['websiteId'];
            }

            $baseUrl = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK);
            $baseMediaUrl = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'catalog/product';

            $baseUrl = Mage::app()->getStore($storeId)->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK);
            $baseMediaUrl = Mage::app()->getStore($storeId)->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'catalog/product';


            echo "SKU\tIMAGEURL\tTITLE\tPRICE\tCURRENCY\tACTIVE\tITEMURL\tCATEGORY\tKEYWORDS\tREPLACEMENTSKU\tINSTOCK\tVIRTUALPARENTCODE\tCATEGORYPATHJSON\tISCATEGORY\tBRAND\tUPC\tMPN\tISBN\tEAN\tJAN\tASIN";
            echo "\n";

            $pageSize = 100;
            $count = Mage::getModel('catalog/product')
                ->getCollection()
                ->addStoreFilter($storeId)
                ->addWebsiteFilter($websiteId)
                ->getSize();

            $page = 1;
            $pages = ceil($count / $pageSize);
            do {
                $collection = Mage::getModel('catalog/product')
                    ->getCollection()
                    ->addAttributeToSelect('*')
                    ->addWebsiteFilter($websiteId)
                    ->addStoreFilter($storeId)
                    ->setPageSize($pageSize)
                    ->setCurPage($page);

                foreach ($collection as $product) {
                    $parents = Mage::getModel('catalog/product_type_configurable')->getParentIdsByChild($product->getId());
                    if (isset($parents[0])) {
                        // skip products with a parent
                        continue;
                    }

//                    $selectionCollection = $product->getTypeInstance(true)->getSelectionsCollection(
//                        $product->getTypeInstance(true)->getOptionsIds($product), $product
//                    );
//
//                    $bundledItems = array();
//                    foreach($selectionCollection as $option)
//                    {
//                        $bundledItems[] = $option->getSku();
//                    }
//                    print_r($bundledItems);

                    //SKU
                    echo $product->getSku();
                    echo "\t";
                    //echo Mage::getModel('catalog/product_media_config')->getMediaUrl( $product->getImage() );
                    // IMAGEURL
                    $imageUrl = null;
                    if ($product->getImage() != null && $product->getImage() != "no_selection") {
                        $imageUrl = Mage::getModel('catalog/product_media_config')->getMediaUrl($product->getImage());
                    } else if ($product->getSmallImage() != null && $product->getSmallImage() != "no_selection") {
                        $imageUrl = Mage::getModel('catalog/product_media_config')->getMediaUrl($product->getSmallImage());
                    } else if ($product->getThumbnail() != null && $product->getThumbnail() != "no_selection") {
                        $imageUrl = Mage::getModel('catalog/product_media_config')->getMediaUrl($product->getThumbnail());
                    }
                    if (!$imageUrl) {
                        echo $product->getImageUrl();
                    } else {
                        echo $imageUrl;
                    }

                    echo "\t";
                    //TITLE
                    echo $product->getName();
                    echo "\t";
                    //PRICE
                    echo $product->getPrice();
                    echo "\t";
                    //CURRENCY
                    echo "\t";
                    //ACTIVE
                    echo 'Y';
                    echo "\t";
                    //ITEMURL
                    echo $product->getProductUrl();
                    echo "\t";
                    //CATEGORY
                    $ids = $product->getCategoryIds();
                    echo(isset($ids[0]) ? 'mag_category_'.$ids[0] : '');
                    echo "\t";
                    // KEYWORDS
                    echo "\t";
                    // REPLACEMENTSKU
                    echo "\t";
                    //VIRTUALPARENTCODE
                    echo "\t";
                    //INSTOCK
                    echo "\t";
                    //CATEGORYPATHJSON
                    echo "\t";
                    //ISCATEGORY
                    echo "n";
                    echo "\t";
                    //BRAND
                    echo $product->getAttributeText('manufacturer');
                    echo "\t";
                    //UPC
                    $upcCode = Mage::getStoreConfig('turnto_admin/general/upc_attribute');
                    echo self::getProductAttributeValue($product, $storeId, $upcCode);
                    echo "\t";
                    //MPN
                    $mpnCode = Mage::getStoreConfig('turnto_admin/general/mpn_attribute');
                    echo self::getProductAttributeValue($product, $storeId, $mpnCode);
                    echo "\t";
                    //ISBN
                    $isbnCode = Mage::getStoreConfig('turnto_admin/general/isbn_attribute');
                    echo self::getProductAttributeValue($product, $storeId, $isbnCode);
                    echo "\t";
                    //EAN
                    $eanCode = Mage::getStoreConfig('turnto_admin/general/ean_attribute');
                    echo self::getProductAttributeValue($product, $storeId, $eanCode);
                    echo "\t";
                    //JAN
                    $janCode = Mage::getStoreConfig('turnto_admin/general/jan_attribute');
                    echo self::getProductAttributeValue($product, $storeId, $janCode);
                    echo "\t";
                    //ASIN
                    $asinCode = Mage::getStoreConfig('turnto_admin/general/asin_attribute');
                    echo self::getProductAttributeValue($product, $storeId, $asinCode);

                    echo "\n";
                }
                $page++;
                $collection->clear();
            } while ($page <= $pages);

            $categories = Mage::getModel('catalog/category')->setStoreId($storeId)->getCollection()->addAttributeToSelect('*');
            if ($categories) {
                foreach ($categories as $category) {
                    $category->setStoreId($storeId);
                    echo 'mag_category_'.$category->getId();
                    echo "\t";
                    //IMAGEURL
                    echo "\t";
                    //TITLE
                    echo $category->getName();
                    echo "\t";
                    //PRICE
                    echo "\t";
                    //CURRENCY
                    echo "\t";
                    //ACTIVE
                    echo "Y";
                    echo "\t";
                    //ITEMURL
                    echo $category->getUrl();
                    echo "\t";
                    //CATEGORY
                    echo $category->getParentCategory()->getId() ? 'mag_category_'.$category->getParentCategory()->getId() : '';
                    echo "\t";
                    //KEYWORDS
                    echo "\t";
                    //REPLACEMENTSKU
                    echo "\t";
                    //VIRTUALPARENTCODE
                    echo "\t";
                    //INSTOCK
                    echo "\t";
                    //CATEGORYPATHJSON
                    echo "\t";
                    //ISCATEGORY
                    echo "Y";
                    echo "\t";
                    //BRAND
                    echo "\t";
                    //UPC
                    echo "\t";
                    //MPN
                    echo "\t";
                    //ISBN
                    echo "\t";
                    //EAN
                    echo "\t";
                    //JAN
                    echo "\t";
                    //ASIN
                    echo "\n";
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return;


    }

    private function getProductAttributeValue($product, $storeId, $code) {
        if ($code != null && $code != '') {
            $attributeText =  $product->getData($code);
            if ($attributeText != null) {
                return $attributeText;
            }
        }
        return '';
    }

    public function versionAction() {
        echo Mage::getConfig()->getNode()->modules->Turnto_Admin->version;
    }
}


