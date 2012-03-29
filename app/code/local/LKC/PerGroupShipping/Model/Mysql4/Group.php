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


class LKC_PerGroupShipping_Model_Mysql4_Group extends Mage_Core_Model_Mysql4_Abstract
{

    protected function _construct()
    {
        $this->_init('LKC_PerGroupShipping/Group', 'id');
    }

}