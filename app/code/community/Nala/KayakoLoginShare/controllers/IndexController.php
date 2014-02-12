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
class Nala_KayakoLoginShare_IndexController extends Mage_Core_Controller_Front_Action {

	/**
	 * validate the user credentials and show an xml output
	 * 
	 * input post params: username, password, website_id(optional)
	 */
	public function indexAction() {
		header('Content-Type: text/xml');

		//get the post params
		$username = $this->getRequest()->getPost('username');
		$password = $this->getRequest()->getPost('password');
		$websiteId = $this->getRequest()->getPost('website_id');

		//helper file
		$helper = Mage::helper('nala_loginshare');

		if ($username && $password && $helper->isEnabled()) {
			try {
				$customer = Mage::getModel('customer/customer');

				//if website scope, then website id is mandatory
				if ($customer->getSharingConfig()->isWebsiteScope()) {
					if (empty($websiteId))
						$websiteId = Mage::app()->getStore()->getWebsiteId();
					$customer->setWebsiteId($websiteId);
				}

				//authenticate the username and password
				$customer->authenticate($username, $password);

				//show success message if no exception is thrown
				echo $helper->showSuccessMsg($customer);
			} catch (Mage_Core_Exception $e) {
				//show error message
				echo $helper->showErrorMsg($e->getMessage());
			} catch (Exception $e) {
				Mage::logException($e);
				//show error message
				echo $helper->showErrorMsg();
			}
		} else {
			echo $helper->showErrorMsg();
		}
		exit();
	}

	/**
	 * for testing the login share is working fine or not..
	 */
	public function testAction() {
		if (!Mage::helper('nala_loginshare')->testEnabled())
			$this->_redirect();

		$this->getResponse()
				->setBody($this->getLayout()
						->createBlock('nala_loginshare/login')
						->toHtml());
	}

}