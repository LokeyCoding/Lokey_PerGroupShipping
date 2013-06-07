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

class Lokey_PerGroupShipping_Block_Admin_Group_Edit extends Mage_Adminhtml_Block_Widget
{

    protected $_group;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('Lokey/PerGroupShipping/group/edit.phtml');
        $this->_group = Mage::getModel('Lokey_PerGroupShipping/Group');
        if ($id = (int)$this->getRequest()->getParam('id')) {
            $this->_group->load($id);
        }
    }

    protected function _prepareLayout()
    {
        $this->setChild(
            'back_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')->setData(
                array(
                     'label'   => Mage::helper('Lokey_PerGroupShipping/Data')->__('Back'),
                     'onclick' => "window.location.href = '" . $this->getUrl('*/*') . "'",
                     'class'   => 'back'
                )
            )
        );

        $this->setChild(
            'reset_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')->setData(
                array(
                     'label'   => Mage::helper('Lokey_PerGroupShipping/Data')->__('Reset'),
                     'onclick' => 'window.location.href = window.location.href'
                )
            )
        );

        $this->setChild(
            'save_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')->setData(
                array(
                     'label'   => Mage::helper('Lokey_PerGroupShipping/Data')->__('Save'),
                     'onclick' => 'groupControl.save();',
                     'class'   => 'save'
                )
            )
        );

        $this->setChild(
            'delete_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')->setData(
                array(
                     'label'   => Mage::helper('Lokey_PerGroupShipping/Data')->__('Delete'),
                     'onclick' => 'groupControl.deleteGroup();',
                     'class'   => 'delete'
                )
            )
        );
        return parent::_prepareLayout();
    }

    public function getBackButtonHtml()
    {
        return $this->getChildHtml('back_button');
    }

    public function getResetButtonHtml()
    {
        return $this->getChildHtml('reset_button');
    }

    public function getSaveButtonHtml()
    {
        return $this->getChildHtml('save_button');
    }

    public function getDeleteButtonHtml()
    {
        return $this->getChildHtml('delete_button');
    }

    /**
     * Return header text for form
     *
     * @return string
     */
    public function getHeaderText()
    {
        if ($this->getEditMode()) {
            return Mage::helper('Lokey_PerGroupShipping/Data')->__('Edit Group');
        }

        return Mage::helper('Lokey_PerGroupShipping/Data')->__('New Group');
    }

    /**
     * Return form block HTML
     *
     * @return string
     */
    public function getForm()
    {
        return $this->getLayout()->createBlock('Lokey_PerGroupShipping/Admin_Group_Edit_Form')
            ->renderPrepare($this->_group)
            ->toHtml();
    }

    /**
     * Return action url for form
     *
     * @return string
     */
    public function getSaveUrl()
    {
        return $this->getUrl('*/*/save');
    }

    /**
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', array('id' => $this->getRequest()->getParam('id')));
    }
}
