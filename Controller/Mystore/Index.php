<?php

namespace Bullseye\Locator\Controller\Mystore;

use Bullseye\Locator\Helper\Data;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\Session;

class Index extends \Magento\Framework\App\Action\Action
{
	protected $_helper;
	protected $_customerSession;
   	protected $_urlInterface;

	public function __construct(
		Context $context,
		Data $helper,
		Session $customerSession
    ){
		parent::__construct($context);
		$this->_helper = $helper;
		$this->_customerSession = $customerSession;
		$this->_urlInterface = $context->getUrl();
	}

	public function execute()
    {
    	if($this->_helper->isCustomerLogin()){
    		$this->_view->loadLayout();
	        $this->_view->getLayout()->initMessages();
	        $this->_view->renderLayout();	
    	}
    	else{
    		$this->_customerSession->setAfterAuthUrl($this->_urlInterface->getCurrentUrl());
            $this->_customerSession->authenticate();
    	}
    }

}