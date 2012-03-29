<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Lokey Coding, LLC - SOFTWARE LICENSE (v1.0)
 * that is bundled with this package in the file LKC_LICENSE.txt.
 *
 * @category   Mage
 * @package    LKC_PerGroupShipping
 * @copyright  Copyright (c) 2009 Lokey Coding, LLC <ip@lokeycoding.com>
 * @license    Lokey Coding, LLC - SOFTWARE LICENSE (v1.0)
 * @author     Lee Saferite <lee.saferite@lokeycoding.com>
 */


class LKC_PerGroupShipping_Helper_Data extends Mage_Core_Helper_Abstract
{

    public function getAdjustmentGroupByProduct(Mage_Catalog_Model_Product $product)
    {
        return Mage::getModel('LKC_PerGroupShipping/Group')->load($product->getData('lkc_shippingadjustments_group'));
    }

}
