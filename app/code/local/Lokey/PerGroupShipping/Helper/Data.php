<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file OSL_LICENSE.txt
 *
 * @category   Mage
 * @package    Lokey_PerGroupShipping
 * @copyright  Copyright (c) 2009-2013 Lokey Coding, LLC <ip@lokeycoding.com>
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author     Lee Saferite <lee.saferite@lokeycoding.com>
 */

class Lokey_PerGroupShipping_Helper_Data extends Mage_Core_Helper_Abstract
{

    public function getAdjustmentGroupByProduct(Mage_Catalog_Model_Product $product)
    {
        return Mage::getModel('Lokey_PerGroupShipping/Group')->load($product->getData('lokey_sa_group'));
    }
}
