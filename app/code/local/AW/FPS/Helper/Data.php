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

class AW_FPS_Helper_Data extends Mage_Core_Helper_Abstract
{
	function getFeaturedProducts(){
		$db = Mage::getSingleton('core/resource')->getConnection('core_write');
		$_productIds = $db->fetchCol("SELECT * FROM aw_fps");
		
	    $__productCollection = null;
        $_productCollection = Mage::getModel('catalog/product')
            ->getCollection()
            ->addIdFilter($_productIds)
            ->addUrlRewrite();
        $_productCollection->load();

		$_res = array();
		foreach($_productCollection as $_product){
			$_product = Mage::getModel('catalog/product')->load($_product->getData('entity_id'));
			$_title = str_replace("'", "\'", $_product->getName());
			$_url = $_product->getProductUrl();
			$_image = $_product->getSmallImageUrl();
			$_price = Mage::helper('core')->formatCurrency($_product->getPrice());
			
			array_push($_res, array(
				'title'	=> $_title,
				'url'	=> $_url,
				'image'	=> $_image,
				'price'	=> $_price
				));
		}

	    return $_res;
	}
}


