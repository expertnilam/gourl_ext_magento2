/**
 * CoinGate payment method model
 *
 * @category    CoinGate
 * @package     CoinGate_Merchant
 * @author      CoinGate
 * @copyright   CoinGate (https://coingate.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
/*browser:true*/
/*global define*/
define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/renderer-list'
    ],
    function (
        Component,
        rendererList
    ) {
        'use strict';
        rendererList.push(
            {
                type: 'escorpien_gourl',
                component: 'Escorpien_Gourl/js/view/payment/gourl-payments/gourl-method'
            }
        );
        /** Add view logic here if needed */
        return Component.extend({});
    }
);
