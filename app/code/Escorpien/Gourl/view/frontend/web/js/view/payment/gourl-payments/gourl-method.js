/**
 * CoinGate JS
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
     'jquery',
     'Magento_Checkout/js/view/payment/default',
     'Magento_Checkout/js/action/place-order',
     'Magento_Checkout/js/action/select-payment-method',
     'Magento_Customer/js/model/customer',
     'Magento_Checkout/js/checkout-data',
     'Magento_Checkout/js/model/payment/additional-validators',
     'mage/url',
 ],
 function (
     $,
     Component,
     placeOrderAction,
     selectPaymentMethodAction,
     customer,
     checkoutData,
     additionalValidators,
     url) {
     'use strict';

     return Component.extend({
         defaults: {
             template: 'Escorpien_Gourl/payment/gourl-form'
         },

         placeOrder: function (data, event) {
             if (event) {
                 event.preventDefault();
             }
             var self = this,
                 placeOrder,
                 emailValidationResult = customer.isLoggedIn(),
                 loginFormSelector = 'form[data-role=email-with-possible-login]';
             if (!customer.isLoggedIn()) {
                 $(loginFormSelector).validation();
                 emailValidationResult = Boolean($(loginFormSelector + ' input[name=username]').valid());
             }
             if (emailValidationResult && this.validate() && additionalValidators.validate()) {
                 this.isPlaceOrderActionAllowed(false);
                 placeOrder = placeOrderAction(this.getData(), false, this.messageContainer);

                 $.when(placeOrder).fail(function () {
                     self.isPlaceOrderActionAllowed(true);
                 }).done(this.afterPlaceOrder.bind(this));
                 return true;
             }
             return false;
         },

         selectPaymentMethod: function() {
             selectPaymentMethodAction(this.getData());
             checkoutData.setSelectedPaymentMethod(this.item.method);
             return true;
         },

         afterPlaceOrder: function (quoteId) {
           var request = $.ajax({
             url: url.build('gourl/payment/placeOrder'),
             type: 'POST',
             dataType: 'json',
             data: {quote_id: quoteId}
           });

           request.done(function(response) {
             if (response.status) {

               window.location.replace(response.payment_url+'id/'+response.order_increment_id);
             } else {
               window.location.replace('/checkout/onepage/failure/id/'+response.order_increment_id);
             }
           });
         }
     });
   }
);
