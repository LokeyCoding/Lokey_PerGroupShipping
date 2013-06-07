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

class Lokey_PerGroupShipping_Block_Admin_Group_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    /**
     * Prepare form for render
     */
    public function renderPrepare($group)
    {
        $form = new Varien_Data_Form();

        if ($this->getRequest()->isPost()) {
            $post = $this->getRequest()->getPost();
            $group->addData($post);
        }

        $fieldset = $form->addFieldset(
            'base_fieldset',
            array(
                 'legend' => Mage::helper('Lokey_PerGroupShipping/Data')->__('Group Information'),
                 'class'  => 'fieldset-wide'
            )
        );

        $fieldset->addField(
            'name',
            'text',
            array(
                 'name'     => 'name',
                 'label'    => Mage::helper('Lokey_PerGroupShipping/Data')->__('Group Name'),
                 'title'    => Mage::helper('Lokey_PerGroupShipping/Data')->__('Group Name'),
                 'class'    => 'required-entry',
                 'required' => true
            )
        );

        $fieldset->addField(
            'type',
            'select',
            array(
                 'name'   => 'type',
                 'label'  => Mage::helper('Lokey_PerGroupShipping/Data')->__('Adjustment Type'),
                 'title'  => Mage::helper('Lokey_PerGroupShipping/Data')->__('Adjustment Type'),
                 'values' => Mage::getSingleton('Lokey_PerGroupShipping/System_Config_Source_AdjustmentType')->toOptionArray(),
            )
        );

        $fieldset->addField(
            'rate_request',
            'select',
            array(
                 'name'   => 'rate_request',
                 'label'  => Mage::helper('Lokey_PerGroupShipping/Data')->__('Use in Rate Request'),
                 'title'  => Mage::helper('Lokey_PerGroupShipping/Data')->__('Use in Rate Request'),
                 'values' => Mage::getSingleton('adminhtml/system_config_source_yesno')->toOptionArray(),
            )
        );

        $fieldset->addField(
            'amount',
            'text',
            array(
                 'name'     => 'amount',
                 'label'    => Mage::helper('Lokey_PerGroupShipping/Data')->__('Amount'),
                 'title'    => Mage::helper('Lokey_PerGroupShipping/Data')->__('Amount'),
                 'class'    => 'required-entry validate-currency',
                 'required' => true
            )
        );

        if ($group->getId()) {
            $form->addField('id', 'hidden', array('name' => 'id'));
        }

        $form->setValues($group->getData());

        if ($values = Mage::getSingleton('adminhtml/session')->getData('lokey_sa_pg_group', true)) {
            $form->setValues($values);
        }

        $this->setForm($form);

        return $this;
    }
}
