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

class Lokey_PerGroupShipping_Model_System_Config_Source_Group extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{

    public function getAllOptions()
    {
        $groups = Mage::getModel('Lokey_PerGroupShipping/Group')->getCollection();
        $default = array(
            'value' => '',
            'label' => Mage::helper('Lokey_PerGroupShipping/Data')->__('-- None --')
        );
        $options = array_merge(array($default), $groups->toOptionArray());
        return $options;
    }

    public function toOptionArray()
    {
        return $this->getAllOptions();
    }
}
