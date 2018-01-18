<?php
/**
 * Receive currencies Source Model
 *
 * @category    Escorpien
 * @package     CoinGate_Gourl
 * @author      Escorpien
 * @copyright   Escorpien (https://coingate.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
namespace Escorpien\Gourl\Model\Source;

class Receivecurrencies
{
    /**
     * @return array
     */
     public function toOptionArray()
     {
         return array(
             array('value' => 'eur', 'label' => 'Euros (€)'),
             array('value' => 'usd', 'label' => 'US Dollars ($)'),
             array('value' => 'btc', 'label' => 'Bitcoin (฿)'),
         );
     }}
