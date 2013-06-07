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

class Lokey_PerGroupShipping_Admin_ShippingAdjustmentGroupController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        if ($this->getRequest()->getQuery('ajax')) {
            $this->_forward('grid');
        } else {
            $this->loadLayout();
            $this->_setActiveMenu('sales/shipping/lokey_sa_group');
            $this->_addContent($this->getLayout()->createBlock('Lokey_PerGroupShipping/Admin_Group', 'group'));
            $this->renderLayout();
        }
    }

    public function gridAction()
    {
        $this->getResponse()->setBody($this->getLayout()->createBlock('Lokey_PerGroupShipping/Admin_Group_Grid')->toHtml());
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $group = $this->_initGroup();
        $isNew = !(bool)$group->getId();

        $this->loadLayout();

        if ($isNew) {
            $this->_addBreadcrumb(
                Mage::helper('Lokey_PerGroupShipping/Data')->__('New Group'),
                Mage::helper('Lokey_PerGroupShipping/Data')->__('Create Shipping Adjustment Group')
            );
        } else {
            $this->_addBreadcrumb(
                Mage::helper('Lokey_PerGroupShipping/Data')->__('Edit Group'),
                Mage::helper('Lokey_PerGroupShipping/Data')->__('Edit Shipping Adjustment Group')
            );
        }

        $contentBlock = $this->getLayout()->createBlock('Lokey_PerGroupShipping/Admin_Group_Edit', 'group_edit');
        $contentBlock->setEditMode(!$isNew);
        $this->_addContent($contentBlock);

        $this->renderLayout();
    }

    public function saveAction()
    {
        if (($data = $this->getRequest()->getPost())) {
            $group = $this->_initGroup();
            $group->addData($data);

            $isNew = !$group->getId();

            try {
                $group->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('Lokey_PerGroupShipping/Data')->__('Adjustment Group was successfully saved'));
            }
            catch (Exception $e) {
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
        if ($group->getId()) {
            try {
                $group->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('Lokey_PerGroupShipping/Data')->__('Adjustment Group was deleted'));
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*');
    }

    protected function _initGroup($idFieldName = 'id')
    {
        $id = (int)$this->getRequest()->getParam($idFieldName);
        $group = Mage::getModel('Lokey_PerGroupShipping/Group');

        if ($id) {
            $group->load($id);
        }

        Mage::register('current_group', $group);

        return $group;
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('catalog/lokey_sa_pg');
    }
}
