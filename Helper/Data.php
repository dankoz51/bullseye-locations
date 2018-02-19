<?php

namespace Bullseye\Locator\Helper;


use Magento\Customer\Model\Session;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

	const LOCATOR_GENERAL_APIKEY = 'locator/general/api_key';
	const LOCATOR_GOOGLE_APIKEY = 'locator/general/google_api_key';
    const LOCATOR_GENERAL_CLIENTID = 'locator/general/client_id';
    const LOCATOR_GENERAL_TOPLINKTEXT = 'locator/general/top_link_text';
    const LOCATOR_GENERAL_ICON = 'locator/general/icon';
    const LOCATOR_GENERAL_DEFAULTSELCTION = 'locator/general/default_selection';
    const LOCATOR_GENERAL_CMS_PAGE = 'locator/general/cms_page';

    const LOCATOR_TEXT_TITLE = 'locator/text/mini_locator_title';
    const LOCATOR_TEXT_SEARCH_TEXT = 'locator/text/mini_locator_search_text';
    const LOCATOR_TEXT_SAVED_STORE_TITLE = 'locator/text/mini_locator_saved_store_title';
    const LOCATOR_TEXT_NO_STORE_MSG = 'locator/text/mini_locator_no_store_msg';
    const LOCATOR_TEXT_NEARBY_STORE_TITLE = 'locator/text/mini_locator_nearby_store_title';
    const LOCATOR_TEXT_SEARCH_STORE_TITLE = 'locator/text/mini_locator_searched_store_title';
    const LOCATOR_TEXT_NO_STORE_NEAR_MSG = 'locator/text/mini_locator_no_nearby_msg';
    const INSECURE_SITE_MSG = 'locator/text/insecure_site_msg';
    const LOCATOR_TEXT_NO_SEARCH_STORE_MSG = 'locator/text/mini_locator_no_searched_store_msg';
    const LOCATOR_TEXT_FIND_STORE_MAP_LINK_TITLE = 'locator/text/mini_locator_find_store_link_title';

	/**
	 * @var \Psr\Log\LoggerInterface
	 */
	protected $_logger;
	protected $_customerSession;
	protected $_filesystem;
	
	public function __construct(
		\Magento\Framework\App\Helper\Context $context,
		Session $customerSession,
		Filesystem $filesystem
	) {
		$this->_logger                  = $context->getLogger();
		$this->_customerSession 		= $customerSession;
		$this->_filesystem 				= $filesystem;
		parent::__construct($context);
	}

	public function getLoginCustomer(){

		return $this->_customerSession->getCustomer();
	}

	public function isCustomerLogin(){

		if($this->_customerSession->isLoggedIn()) {
			return true;
		}
		return false;
	}

	public function getMediaPath(){

		return $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath();

	}

	public function getAddressID(){

		if(!$this->isCustomerLogin()){

            $id = isset($_COOKIE['storeaddressid']) ? $_COOKIE['storeaddressid'] : 0;    
        }
    	else{

            $id = 0;
            $customer = $this->getLoginCustomer();
            if($customer->getAddressId() != ''){
                $id = $customer->getAddressId();
            }
        }

    	return $id;
	}

	public function getSavedStore(){

		if(!$this->isCustomerLogin()){

            $store = isset($_COOKIE['savedstore']) ? $_COOKIE['savedstore'] : 0;    
        }
        else{

            $store = json_encode(array());
            $customer = $this->getLoginCustomer();
            if($customer->getSavedStore() != ''){
                $store = $customer->getSavedStore();    
            }
        }
    	return $store;
	}

	public function getConfig($identifier){

		return $this->scopeConfig->getValue(
			$identifier,
			\Magento\Store\Model\ScopeInterface::SCOPE_STORE
		);
	}

	public function isPrefillEbable(){

		return $this->getConfig(self::LOCATOR_GENERAL_DEFAULTSELCTION);
	}

	public function toDataArray($obj){

		$data = array();

		if(is_object($obj)){
			foreach ($obj as $key => $value) {
				$data[$key] = $value;
			}	
		}
		return $data;
	}
}