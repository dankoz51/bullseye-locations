<?php
 
namespace Bullseye\Locator\Block;

use Magento\Framework\Stdlib\CookieManagerInterface;
use Bullseye\Locator\Helper\Data;

class Link extends \Magento\Framework\View\Element\Html\Link
{

    protected $_cookieManager;
    protected $_helper;
    
	public function __construct(
		\Magento\Catalog\Block\Product\Context $context, 
		CookieManagerInterface $cookieManager,
        Data $helper,
        array $data = []
	) {
	    parent::__construct($context, $data);
	    $this->_cookieManager = $cookieManager;
        $this->_helper = $helper;
    }

    public function getAddressID(){
        
        return $this->getHelper()->getAddressID();
    }

    public function savedstore(){

        return $this->getHelper()->getSavedStore();
    }

    public function getApiKey(){

        return $this->getHelper()->getConfig(Data::LOCATOR_GENERAL_APIKEY);
    }

    public function getGoogleApiKey(){

        return $this->getHelper()->getConfig(Data::LOCATOR_GOOGLE_APIKEY);
    }

    public function getClientId(){

        return $this->getHelper()->getConfig(Data::LOCATOR_GENERAL_CLIENTID);
    }

    public function getTopLinkText(){

        return $this->getHelper()->getConfig(Data::LOCATOR_GENERAL_TOPLINKTEXT);
    }

    public function getIcon()
    {
        $icon = $this->getHelper()->getConfig(Data::LOCATOR_GENERAL_ICON);
        if(empty($icon) !== true){
            return $this->getUrl('pub/media/icon') .'/'. $this->getHelper()->getConfig(Data::LOCATOR_GENERAL_ICON);
        }else{
            return $this->getViewFileUrl('Bullseye_Locator::images/bullseye.png');
        }
        
    }

    public function getCmsPageLink(){

        return $this->getUrl($this->getHelper()->getConfig(Data::LOCATOR_GENERAL_CMS_PAGE));
    }

    public function getMiniLocatorTitle(){

        return $this->getHelper()->getConfig(Data::LOCATOR_TEXT_TITLE);
    }

    public function getSearchText(){

        return $this->getHelper()->getConfig(Data::LOCATOR_TEXT_SEARCH_TEXT);
    }

    public function getSavedStoreTitle(){

        return $this->getHelper()->getConfig(Data::LOCATOR_TEXT_SAVED_STORE_TITLE);   
    }

    public function getNoSavedStoreMsg(){

        return $this->getHelper()->getConfig(Data::LOCATOR_TEXT_NO_STORE_MSG);
    }

    public function getNearByStoreTitle(){
        
        return $this->getHelper()->getConfig(Data::LOCATOR_TEXT_NEARBY_STORE_TITLE);
    }

    public function getSearchStoreTitle(){
        
        return $this->getHelper()->getConfig(Data::LOCATOR_TEXT_SEARCH_STORE_TITLE);
    }

    public function getNoStoreNearByMsg(){
        
        return $this->getHelper()->getConfig(Data::LOCATOR_TEXT_NO_STORE_NEAR_MSG);
    }

    public function getInsecureSiteMsg(){
        
        return $this->getHelper()->getConfig(Data::INSECURE_SITE_MSG);
    }

    public function getNoSearchStoreMsg(){
        
        return $this->getHelper()->getConfig(Data::LOCATOR_TEXT_NO_SEARCH_STORE_MSG);   
    }

    public function getFindOnMapLink(){
        
        return $this->getHelper()->getConfig(Data::LOCATOR_TEXT_FIND_STORE_MAP_LINK_TITLE);
    }

    public function getHelper(){

        return $this->_helper;
    }
}