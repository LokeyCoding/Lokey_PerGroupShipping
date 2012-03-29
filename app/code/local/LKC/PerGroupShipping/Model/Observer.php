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



class LKC_PerGroupShipping_Model_Observer
{

    public function filterRateRequest(Varien_Event_Observer $observer)
    {
        $store = $observer->getStore();
        $request = $observer->getRequest();
        $allItems = $observer->getAllItems();
        $removedItems = $observer->getRemovedItems();

        foreach ($allItems as $item)
        {
            $product = Mage::getModel('catalog/product')->setStoreId($store->getId())->load($item->getProductId());
            $group = Mage::helper('LKC_PerGroupShipping')->getAdjustmentGroupByProduct($product);
            if ($group->getId() && ! (bool) $group->getRateRequest() && ! $removedItems->getItemById($item->getId()))
            {
                $removedItems->addItem($item);
            }
        }

        return $this;
    }

    public function calculateAdjustment(Varien_Event_Observer $observer)
    {
        $store = $observer->getStore();
        $request = $observer->getRequest();
        $allItems = $observer->getAllItems();
        $adjustments = $observer->getAdjustments();

        $groupAdjustments = array();
        $itemAdjustments = $adjustments->getItems();

        foreach ($allItems as $item)
        {
            $qty = $item->getQty();
            if($item->getParentItem())
            {
                $qty *= $item->getParentItem()->getQty();
            }
            $qty -= $item->getFreeQuantity();
            $qty = max($qty, 0);

            if($request->getFreeShipping() || $qty === 0)
            {
                continue;
            }

            $product = Mage::getModel('catalog/product')->setStoreId($store->getId())->load($item->getProductId());
            $group = Mage::helper('LKC_PerGroupShipping')->getAdjustmentGroupByProduct($product);

            if (!$product->getTypeInstance()->isVirtual() && $group->getId())
            {
                $adjustment = max(round($group->getAmount(), 2), 0.0);

                switch ($group->getType())
                {
                    case LKC_PerGroupShipping_Model_System_Config_Source_AdjustmentType::ORDER:
                        $groupAdjustments[$group->getId()] = $adjustment;
                        break;
                    case LKC_PerGroupShipping_Model_System_Config_Source_AdjustmentType::LINE:
                        if (!isset($itemAdjustments[$item->getId()]))
                        {
                            $itemAdjustments[$item->getId()] = 0.0;
                        }
                        $itemAdjustments[$item->getId()] += $adjustment;
                        break;
                    case LKC_PerGroupShipping_Model_System_Config_Source_AdjustmentType::UNIT:
                    default:
                        if (!isset($itemAdjustments[$item->getId()]))
                        {
                            $itemAdjustments[$item->getId()] = 0.0;
                        }
                        $itemAdjustments[$item->getId()] += ( $adjustment * $qty );
                        break;
                }
            }
        }

        foreach ($groupAdjustments as $groupAdjustment)
        {
            $adjustments->setOrder($adjustments->getOrder() + $groupAdjustment);
        }
        $adjustments->setItems($itemAdjustments);

        return $this;
    }

}