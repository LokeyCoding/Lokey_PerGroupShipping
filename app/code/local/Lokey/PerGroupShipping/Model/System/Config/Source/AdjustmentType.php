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

class Lokey_PerGroupShipping_Model_System_Config_Source_AdjustmentType extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
    const UNIT  = 0;
    const LINE  = 1;
    const ORDER = 2;

    public function getAllOptions()
    {
        $options = array(
            array(
                'value' => self::UNIT,
                'label' => Mage::helper('Lokey_PerGroupShipping/Data')->__('Unit')
            ),
            array(
                'value' => self::LINE,
                'label' => Mage::helper('Lokey_PerGroupShipping/Data')->__('Line')
            ),
            array(
                'value' => self::ORDER,
                'label' => Mage::helper('Lokey_PerGroupShipping/Data')->__('Order')
            ),
        );
        return $options;
    }

    public function toOptionArray()
    {
        return $this->getAllOptions();
    }
}