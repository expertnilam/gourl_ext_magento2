<?php
/**
 *  ... Please MODIFY this file ... 
 *
 *
 *  YOUR MYSQL DATABASE DETAILS
 *
 */

 define("DB_HOST", 	"localhost");				// hostname
 define("DB_USER", 	"root");		// database username
 define("DB_PASSWORD", 	"root");		// database password
 define("DB_NAME", 	"gourl");	// database name




/**
 *  ARRAY OF ALL YOUR CRYPTOBOX PRIVATE KEYS
 *  Place values from your gourl.io signup page
 *  array("your_privatekey_for_box1", "your_privatekey_for_box2 (otional), etc...");
 */
 
$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
$coinCollection = $objectManager->create('Escorpien\Gourl\Model\ResourceModel\Coin\Collection')
->addFieldToFilter('enabled', ['eq' => 1]);
$coinCollection->load();
$coinPrivatekeys = array();
foreach ($coinCollection as $key => $coin) {
	$coinPrivatekeys[] = $coin->getPrivateKey();
}
 
 $cryptobox_private_keys = $coinPrivatekeys;




 define("CRYPTOBOX_PRIVATE_KEYS", implode("^", $cryptobox_private_keys));
 unset($cryptobox_private_keys); 

?>