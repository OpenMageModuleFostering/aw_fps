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

class AW_FPS_Model_Entity_Attribute_Backend_Boolean_Config extends Mage_Eav_Model_Entity_Attribute_Backend_Abstract
{
    /**
     * Set attribute default value if value empty
     *
     * @param Varien_Object $object
     */
    public function afterLoad($object)
    {
        if(!$object->hasData($this->getAttribute()->getAttributeCode())) {
            $object->setData($this->getAttribute()->getAttributeCode(), $this->getDefaultValue());
        }
    }

    /**
     * Set attribute default value if value empty
     *
     * @param Varien_Object $object
     */
    public function beforeSave($object)
    {
    
    	$write = Mage::getSingleton('core/resource')->getConnection('core_write');
    	$product_id = $object->getData('entity_id');
    	
    	$code = $object->getData($this->getAttribute()->getAttributeCode());
        if($code == 0) {
            $object->unsData($this->getAttribute()->getAttributeCode());
            //remove product ID
            $write->query("DELETE FROM aw_fps WHERE product_id='$product_id'");
        }
        else{
        	//add project ID to the rotation
        	$r = $write->fetchRow("SELECT * FROM aw_fps WHERE product_id='$product_id'");
        	if(!$r)
      			$write->query("INSERT INTO aw_fps (product_id) VALUE ($product_id)");
        }
    }

}
