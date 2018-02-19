<?php 

namespace Bullseye\Locator\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Bullseye\Locator\Helper\Data;

class Nearestlocation extends Template implements BlockInterface
{
	protected $_template = "widget/nearestlocation.phtml";
	protected $_helper;

	public function __construct(\Magento\Framework\View\Element\Template\Context $context, Data $helper){
		parent::__construct($context);
		$this->_helper = $helper;

	}

	public function getApiKey(){
		
        return $this->getHelper()->getConfig(Data::LOCATOR_GENERAL_APIKEY);
    }

    public function getClientId(){

        return $this->getHelper()->getConfig(Data::LOCATOR_GENERAL_CLIENTID);
    }

    public function getHelper(){

        return $this->_helper;
    }

    public function getSearchRadius(){
        
    	return $this->getData('search_radius');
    }

    public function getNotFoundTextMessage(){

    	return $this->getData('not_found_text');
    }

    public function getStoreLimit(){

        return $this->getData('max_store');
    }

    public function getWidgetTitle(){

        return $this->getData('title');   
    }

    public function getViewType(){

        return $this->getData('view');   
    }
}
