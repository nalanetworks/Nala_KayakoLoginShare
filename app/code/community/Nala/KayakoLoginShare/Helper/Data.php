<?php
/**
 * Nala Networks Inc 
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to support@nalanetworks.com so we can send you a copy immediately.
 *
 * @category   Nala 
 * @package    Nala_KayakoLoginShare 
 * @copyright  Copyright (c) 2014 Nala Networks Inc (http://www.nalanetworks.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */ 
 
/**
 * Magento Kayako Login Share Module
 */
class Nala_KayakoLoginShare_Helper_Data extends Mage_Core_Helper_Abstract {

	/**
	 * show error messages
	 * 
	 * @param string $error
	 * @return xml
	 */
	public function showErrorMsg($error = '') {
		if (empty($error))
			$error = $this->__('Invalid Username or Password');

		$errXML = '<?xml version="1.0" encoding="UTF-8"?>' .
				'<loginshare>' .
				'<result>0</result>' .
				'<message>' . $error . '</message>' .
				'</loginshare>';
		return $errXML;
	}

	/**
	 * show success messages
	 * 
	 * @param Mage_Customer_Model_Customer $customer
	 * @return xml
	 */
	public function showSuccessMsg($customer) {
		$billingAddress = $customer->getDefaultBillingAddress();
		if ($billingAddress) {
			$customer->setTelephone($billingAddress->getTelephone());
		}
		
		$xml = '<?xml version="1.0" encoding="UTF-8"?>' .
				'<loginshare>' .
				'<result>1</result>' .
				'<user>' .
				'<status>1</status>' .
				'<usergroup>Registered</usergroup>' .
				'<fullname>' . $customer->getName() . '</fullname>' .
				'<username>' . $customer->getUsername() . '</username>' .
				'<designation>customer</designation>' .
				'<emails>' .
				'<email>' . $customer->getEmail() . '</email>' .
				'</emails>' .
				'<phone>' . $customer->getTelephone() . '</phone>' .
				'</user>' .
				'</loginshare>';
		return $xml;
	}
	
	/**
	 * check if kayako module is enabled or not
	 * 
	 * @param mixed $store
	 * @return boolean
	 */
	public function isEnabled($store=null) {
		return Mage::getStoreConfig('customer/account_share/kayako_login_share', $store);
	}
	
	/**
	 * check if test enabled
	 * 
	 * @param mixed $store
	 * @return boolean
	 */
	public function testEnabled($store=null) {
		return Mage::getStoreConfig('customer/account_share/kayako_login_share_test', $store) && $this->isEnabled($store);
	}

}