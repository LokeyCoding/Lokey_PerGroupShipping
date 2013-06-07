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

$this->startSetup();

$this->run("
    -- DROP TABLE IF EXISTS `{$this->getTable('Lokey_PerGroupShipping/Group')}`;
    CREATE TABLE `{$this->getTable('Lokey_PerGroupShipping/Group')}` (
        `id`           INT UNSIGNED           NOT NULL AUTO_INCREMENT,
        `name`         VARCHAR(150)           DEFAULT NULL,
        `type`         TINYINT(1) UNSIGNED    DEFAULT '0',
        `amount`       DECIMAL(10,2) UNSIGNED DEFAULT '0.00',
        `rate_request` BOOLEAN                DEFAULT '0',
        PRIMARY KEY  (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Shipping Adjustment Groups';
");

$this->addAttribute(
    'catalog_product',
    'lokey_sa_group',
    array(
         'group'    => 'Shipping',
         'type'     => 'int',
         'source'   => 'Lokey_PerGroupShipping/System_Config_Source_Group',
         'label'    => 'Shipping Adjustment Group',
         'input'    => 'select',
         'global'   => 0,
         'required' => false,
         'default'  => null
    )
);

$this->endSetup();
