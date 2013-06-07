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

/* @var $this Mage_Eav_Model_Entity_Setup */

$this->startSetup();

if ($this->getAttribute('catalog_product', 'lokey_shippingadjustments_group') && !$this->getAttribute('catalog_product', 'lokey_sa_group')) {
    $this->updateAttribute('catalog_product', 'lokey_shippingadjustments_group', 'attribute_code', 'lokey_sa_group');
}

$this->endSetup();
