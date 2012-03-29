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


class LKC_PerGroupShipping_Block_Admin_Group_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    protected function _construct()
    {
        $this->setEmptyText(Mage::helper('LKC_PerGroupShipping')->__('No Groups Found'));
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('LKC_PerGroupShipping/Group')->getCollection();

        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('id', array(
            'header' => Mage::helper('LKC_PerGroupShipping')->__('ID'),
            'width' => '50px',
            'type' => 'number',
            'index' => 'id',
        ));

        $this->addColumn('name', array(
            'header' => Mage::helper('LKC_PerGroupShipping')->__('Name'),
            'index' => 'name'
        ));

        $options = array();
        foreach (Mage::getSingleton('LKC_PerGroupShipping/System_Config_Source_AdjustmentType')->toOptionArray() as $entry)
        {
            $options[$entry['value']] = $entry['label'];
        }
        $this->addColumn('type', array(
            'header' => Mage::helper('LKC_PerGroupShipping')->__('Adjustment Type'),
            'index' => 'type',
            'type' => 'options',
            'options' => $options,
        ));

        $options = array();
        foreach (Mage::getSingleton('adminhtml/system_config_source_yesno')->toOptionArray() as $entry)
        {
            $options[$entry['value']] = $entry['label'];
        }
        $this->addColumn('rate_request', array(
            'header' => Mage::helper('LKC_PerGroupShipping')->__('Rate Request'),
            'index' => 'rate_request',
            'type' => 'options',
            'options' => $options,
        ));

        $this->addColumn('amount', array(
            'header' => Mage::helper('LKC_PerGroupShipping')->__('Amount'),
            'index' => 'amount',
            'type' => 'currency'
        ));

        return $this;
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}