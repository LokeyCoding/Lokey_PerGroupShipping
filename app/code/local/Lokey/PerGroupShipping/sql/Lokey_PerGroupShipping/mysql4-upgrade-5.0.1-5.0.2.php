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

/* @var $this Mage_Eav_Model_Entity_Setup */

$this->startSetup();

if ($this->getAttribute('catalog_product', 'lokey_shippingadjustments_group') && !$this->getAttribute('catalog_product', 'lokey_sa_group')) {
    $this->updateAttribute('catalog_product', 'lokey_shippingadjustments_group', 'attribute_code', 'lokey_sa_group');
}

$this->endSetup();
