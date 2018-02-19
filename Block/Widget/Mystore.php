<?php 

namespace Bullseye\Locator\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Bullseye\Locator\Helper\Data;
use Magento\Framework\App\Request\Http;

class Mystore extends Template implements BlockInterface
{
	protected $_template = "widget/mystore.phtml";
	protected $_helper;
	protected $_savedStore;
    protected $_request;

	public function __construct(\Magento\Framework\View\Element\Template\Context $context, Data $helper, Http $request){
		parent::__construct($context);
		$this->_helper = $helper;
        $this->_request = $request;
		$this->loadSavedStore();
	}

	public function isCustomerLogin(){

		return $this->getHelper()->isCustomerLogin();
	}

    public function getHelper(){

        return $this->_helper;
    }

    public function getRequest(){

        return $this->_request;
    }

    public function getAddressID(){

    	return $this->getHelper()->getAddressID();
    }

    public function loadSavedStore(){

    	if(!$this->_savedStore){

    		$this->_savedStore = $this->getHelper()->toDataArray(json_decode($this->getHelper()->getSavedStore()));	
    	}
    	
    	return $this->_savedStore;
    }

    public function getLatitude(){

    	return isset($this->_savedStore['latitude']) ? $this->_savedStore['latitude'] : 0;
    }

    public function getLongitude(){

    	return isset($this->_savedStore['longitude']) ? $this->_savedStore['longitude'] : 0;
    }

    public function getCity(){

    	return isset($this->_savedStore['city']) ? $this->_savedStore['city'] : '';
    }

    public function getAddress(){

    	return isset($this->_savedStore['address']) ? $this->_savedStore['address'] : '';
    }

    public function getWidgetTitle(){

        return $this->getData('title');   
    }

    public function canLoadLibrary(){
        
        $moduleName = $this->getRequest()->getModuleName();
        $controller = $this->getRequest()->getControllerName();
        $action     = $this->getRequest()->getActionName();
        
        if($moduleName == 'bullseye' && $controller == 'viewall' && $action == 'index'){

            return false;
        }
        return true;
    }
}
