<?php
/**
 *
 * @category    Turnto
 * @package     Turnto_Admin
 * @copyright   
 */

/**
 * Catalog product model
 *
 *
 * @category    Turnto
 * @package     Turnto_Admin
 * @author      nanowebgroup.com
 */
class Turnto_Admin_Model_Review_Review extends Mage_Review_Model_Review
{

    /**
     * Append review summary to product collection
     *
     * @param Mage_Catalog_Model_Resource_Eav_Mysql4_Product_Collection $collection
     * @return Mage_Review_Model_Review
     */
    public function appendSummary($collection)
    {
        $entityIds = array();
        foreach ($collection->getItems() as $_itemId => $_item) {
            $entityIds[] = $_item->getEntityId();
        }

        if (sizeof($entityIds) == 0) {
            return $this;
        }
        
        $ratingData = Mage::getModel('turnto_admin/rating')
                                  ->getCollection()
                                  ->addFieldToFilter('product_id', $entityIds)
                                  ->load();
        
        $ratingArray = array();
        
        foreach ($collection->getItems() as $_item ) {
            foreach ($ratingData as $_rate) {
                if ($_rate->getProductId() == $_item->getEntityId()) {
                    
                    $_summary = new Varien_Object();
                    $_summary
                        ->setReviewsCount($_rate->getReviewCount())
                        ->setRatingSummary($_rate->getRating() * 20)
                    ;
                    
                    $_item->setRatingSummary($_summary);
                }
            }
        }
        
        return $this;
    }
    
}

