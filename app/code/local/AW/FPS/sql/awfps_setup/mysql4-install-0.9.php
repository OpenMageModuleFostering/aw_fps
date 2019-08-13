<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category   AW
 * @package    AW_FPS
 * @copyright  Copyright (c) 2008 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

$installer = $this;

/* $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();

$installer->run("
DROP TABLE IF EXISTS {$this->getTable('aw_fps')};
CREATE TABLE {$this->getTable('aw_fps')} (
    `product_id` int,
	UNIQUE (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

$setup = new Mage_Eav_Model_Entity_Setup('core_setup');


$setup->addAttribute('catalog_product', 'aw_fps_available', array(
        'backend'       => 'awfps/entity_attribute_backend_boolean_config',
        'source'        => 'awfps/entity_attribute_source_boolean_config',
        'frontend'      => '',
        'label'         => 'Rotate in featured products slideshow',
        'input'         => 'select',
        'class'         => '',
        'global'        => true,
        'visible'       => true,
        'required'      => false,
        'user_defined'  => false,
        'default'       => '0',
        'visible_on_front' => false
    ));

$installer->endSetup();