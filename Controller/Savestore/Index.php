<?php

namespace Bullseye\Locator\Controller\Savestore;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\Http;
use Bullseye\Locator\Helper\Data;
use Magento\Framework\Stdlib\CookieManagerInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;

class Index extends \Magento\Framework\App\Action\Action
{

    protected $_http;
    protected $_helper;
    protected $_result;
    protected $_cookieManager;
    protected $_customer;
    protected $customerRepository;

    public function __construct(
        Context $context,
        Http $http,
        Data $helper,
        CookieManagerInterface $cookieManager,
        CustomerRepositoryInterface $customerRepository
    ){
        parent::__construct($context);
        $this->_http = $http;
        $this->_helper = $helper;
        $this->_cookieManager = $cookieManager;
        $this->customerRepository = $customerRepository;
    }

    public function execute()
    {
        $results = array();

        $addressid = $this->getHttp()->getParam('addressid');

        $data = array();
        $data['city'] = $this->getHttp()->getParam('city');
        $data['address'] = $this->getHttp()->getParam('address');
        $data['distance'] = $this->getHttp()->getParam('distance');
        $data['countryCode'] = $this->getHttp()->getParam('CountryCode');
        $data['state'] = $this->getHttp()->getParam('State');
        $data['postCode'] = $this->getHttp()->getParam('PostCode');
        $data['latitude'] = $this->getHttp()->getParam('latitude');
        $data['longitude'] = $this->getHttp()->getParam('longitude');


        if(!$this->getHelper()->isCustomerLogin()){

            setcookie('storeaddressid', $addressid, time() + (86400 * 30), "/"); 
            setcookie('savedstore', json_encode($data), time() + (86400 * 30), "/"); 
        }
        else{
                
            $customer = $this->customerRepository->getById($this->getHelper()->getLoginCustomer()->getId());
            $customer->setCustomAttribute('address_id',$addressid);
            $customer->setCustomAttribute('saved_store',json_encode($data));
            $customer = $this->customerRepository->save($customer);
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setRefererOrBaseUrl();
        return $resultRedirect;

    }

    public function getHttp(){

        return $this->_http;
    }

    public function getHelper(){

        return $this->_helper;
    }
}