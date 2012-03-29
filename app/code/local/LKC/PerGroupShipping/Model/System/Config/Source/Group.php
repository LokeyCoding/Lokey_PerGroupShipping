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



class LKC_PerGroupShipping_Model_System_Config_Source_Group extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{

    public function getAllOptions()
    {
        $groups = Mage::getModel('LKC_PerGroupShipping/Group')->getCollection();
        $default = array('value' => '', 'label' => Mage::helper('LKC_PerGroupShipping')->__('-- None --'));
        $options = array_merge(array($default), $groups->toOptionArray());
        return $options;
    }

    public function toOptionArray()
    {
        return $this->getAllOptions();
    }

}