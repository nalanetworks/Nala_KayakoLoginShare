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
class Nala_KayakoLoginShare_Block_Login extends Mage_Core_Block_Template {

	/**
	 * Render block HTML
	 *
	 * @return string
	 */
	protected function _toHtml() {
		$html = '<form action="'.$this->getUrl('nala_loginshare').'" method="post" name="authform" align="">' .
				'<span>Login Type</span><br>' .
				'<span>Username</span><br>' .
				'<input type="text" name="username" size="16" value="" /><br>' .
				'<span>Password</span><br>' .
				'<input type="password" name="password" size="16" value="" /><br>' .
				'<input type="submit" value="login" />' .
				'</form>';
		return $html;
	}

}