/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
/*global define*/
define(
    [
        'jquery',
        'Magento_Checkout/js/model/quote',
        'uiComponent'
    ],
    function ($,quote,Component) {
        'use strict';
        var canUpdate = false;
        quote.shippingAddress.subscribe(function () {
            var postcode = $('input[name="postcode"]').val();
            if ((typeof postcode == 'undefined' || postcode == '' )
                && window.checkoutConfig.is_prefill_enable == 1 
                && window.checkoutConfig.address_id > 0) {
                canUpdate = true;
                var defaultPostCode = window.checkoutConfig.default_postcode;
                var defaultCity = window.checkoutConfig.default_city;
                var defaultCountry = window.checkoutConfig.default_country;

                $('input[name="country_id"]').val(defaultCountry).trigger('change');
                $('input[name="city"]').val(defaultCity);
                $('input[name="postcode"]').val(defaultPostCode).trigger('keyup');
            } else {
                console.log("postcode::");
            }

        });

        setInterval(function() {

            if (canUpdate) {
                var postcode = $('input[name="postcode"]').val();
                if (typeof postcode != 'undefined' ) {
                    canUpdate = false;
                }
                var defaultPostCode = window.checkoutConfig.default_postcode;
                var defaultCity = window.checkoutConfig.default_city;
                var defaultCountry = window.checkoutConfig.default_country;

                $('input[name="country_id"]').val(defaultCountry).trigger('change');
                $('input[name="city"]').val(defaultCity);
                $('input[name="postcode"]').val(defaultPostCode).trigger('keyup');
            }
        }, 1000);

        return Component.extend({});
    }
);
