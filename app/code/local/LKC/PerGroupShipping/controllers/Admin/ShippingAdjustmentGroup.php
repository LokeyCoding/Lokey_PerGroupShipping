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



class LKC_PerGroupShipping_Admin_ShippingAdjustmentGroup extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        if ($this->getRequest()->getQuery('ajax'))
        {
            $this->_forward('grid');
        }
        else
        {
            $this->loadLayout();
            $this->_setActiveMenu('sales/shipping/lkc_sa_group');
            $this->_addContent($this->getLayout()->createBlock('LKC_PerGroupShipping_Admin/Group', 'group'));
            $this->renderLayout();
        }
    }

    public function gridAction()
    {
        $this->getResponse()->setBody($this->getLayout()->createBlock('LKC_PerGroupShipping_Admin/Group_Grid')->toHtml());
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $group = $this->_initGroup();
        $isNew = !(bool) $group->getId();

        $this->loadLayout();

        if ($isNew)
        {
            $this->_addBreadcrumb(
                Mage::helper('LKC_PerGroupShipping')->__('New Group'),
                Mage::helper('newsletter')->__('Create Shipping Adjustment Group')
            );
        }
        else
        {
            $this->_addBreadcrumb(
                Mage::helper('LKC_PerGroupShipping')->__('Edit Group'),
                Mage::helper('newsletter')->__('Edit Shipping Adjustment Group')
            );
        }

        $contentBlock = $this->getLayout()->createBlock('LKC_PerGroupShipping_Admin/Group_Edit', 'group_edit');
        $contentBlock->setEditMode(!$isNew);
        $this->_addContent($contentBlock);

        $this->renderLayout();
    }

    public function saveAction()
    {
        if (($data = $this->getRequest()->getPost()))
        {
            $group = $this->_initGroup();
            $group->addData($data);

            $isNew = !$group->getId();

            try
            {
                $group->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('LKC_PerGroupShipping')->__('Adjustment Group was successfully saved'));
            }
            catch (Exception $e)
            {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setGroupData($data);
                $this->getResponse()->setRedirect($this->getUrl('*/*/*', array('_current' => true)));
                return;
            }
        }

        $this->getResponse()->setRedirect($this->getUrl('*/*'));
    }

    public function deleteAction()
    {
        $group = $this->_initGroup();
        if ($group->getId())
        {
            try
            {
                $group->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('LKC_PerGroupShipping')->__('Adjustment Group was deleted'));
            }
            catch (Exception $e)
            {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*');
    }

    protected function _initGroup($idFieldName = 'id')
    {
        $id = (int) $this->getRequest()->getParam($idFieldName);
        $group = Mage::getModel('LKC_PerGroupShipping/Group');

        if ($id)
        {
            $group->load($id);
        }

        Mage::register('current_group', $group);

        return $group;
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('catalog/lkc_sa_pg');
    }

}