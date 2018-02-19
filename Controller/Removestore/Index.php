<?php

namespace Bullseye\Locator\Controller\Removestore;

use Magento\Framework\App\Action\Context;
use Bullseye\Locator\Helper\Data;
use Magento\Framework\Stdlib\CookieManagerInterface;

class Index extends \Magento\Framework\App\Action\Action
{

	protected $_helper;
    protected $_result;
    protected $_cookieManager;

	public function __construct(
		Context $context,
		Data $helper,
        CookieManagerInterface $cookieManager
	){
		parent::__construct($context);
		$this->_helper = $helper;
        $this->_cookieManager = $cookieManager;
	}

    public function execute()
    {
    	$results = array();

    	if(!$this->getHelper()->isCustomerLogin()){

            setcookie('storeaddressid', '', time() + (86400 * 30), "/"); 
            setcookie('savedstore', '', time() + (86400 * 30), "/"); 
        }
        else{

            $customer = $this->getHelper()->getLoginCustomer();
            $customer->setAddressId('');
            $customer->setSavedStore('');
            $customer->save();
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setRefererOrBaseUrl();
        return $resultRedirect;

    }

    public function getHelper(){

        return $this->_helper;
    }
}