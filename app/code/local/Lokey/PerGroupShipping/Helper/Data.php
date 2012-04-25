<?php
/**
 * NOTICE OF LICENSE
 * This source file is subject to the Lokey Coding, LLC - SOFTWARE LICENSE (v1.0)
 * that is bundled with this package in the file Lokey_LICENSE.txt.
 *
 * @category   Mage
 * @package    Lokey_PerGroupShipping
 * @copyright  Copyright (c) 2009 Lokey Coding, LLC <ip@lokeycoding.com>
 * @license    Lokey Coding, LLC - SOFTWARE LICENSE (v1.0)
 * @author     Lee Saferite <lee.saferite@lokeycoding.com>
 */

class Lokey_PerGroupShipping_Helper_Data extends Mage_Core_Helper_Abstract
{

    public function getAdjustmentGroupByProduct(Mage_Catalog_Model_Product $product)
    {
        return Mage::getModel('Lokey_PerGroupShipping/Group')->load($product->getData('lokey_sa_group'));
    }
}
