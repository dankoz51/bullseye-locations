<?php
namespace Bullseye\Locator\Plugin\Checkout\Model;

use Bullseye\Locator\Helper\Data;
use Magento\Checkout\Model\Session as CheckoutSession;


class DefaultConfigProvider
{
    
    protected $_helper;
    protected $_checkoutSession;

    public function __construct(
        Data $helper,
        CheckoutSession $checkoutSession
    ) {
        
        $this->_helper = $helper;
        $this->_checkoutSession = $checkoutSession;
    }

    public function aroundGetConfig(
        \Magento\Checkout\Model\DefaultConfigProvider $subject,
        \Closure $proceed
    ) {

        $result = $proceed();

        $addressID = $this->getHelper()->getAddressID();

        $result['address_id'] = 0;

        $result['is_prefill_enable'] = $this->getHelper()->isPrefillEbable();

        if($addressID != 0){

            $savedStore = json_decode($this->getHelper()->getSavedStore());

            $savedStore = $this->toDataArray($savedStore);

            $result['address_id'] =  $addressID;

            $result['default_postcode'] = isset($savedStore['postCode']) ? $savedStore['postCode'] : '';

            $result['default_city'] = isset($savedStore['city']) ? $savedStore['city'] : '';

            $result['default_country'] = isset($savedStore['countryCode']) ? $savedStore['countryCode'] : '';
        }
        
        return $result;
    }

    public function toDataArray($obj){

        $data = array();

        foreach ($obj as $key => $value) {
            
            $data[$key] = $value;            
        }

        return $data;
    }

    public function getHelper(){

        return $this->_helper;
    }
}