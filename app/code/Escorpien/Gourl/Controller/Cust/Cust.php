<?php

namespace Escorpien\Gourl\Controller\Cust;

class Cust extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Magento\Customer\Model\CustomerFactory
     */
    protected $customerFactory;

    /**
     * @param \Magento\Framework\App\Action\Context      $context
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Customer\Model\CustomerFactory    $customerFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Customer\Model\CustomerFactory $customerFactory
    ) {
        $this->storeManager     = $storeManager;
        $this->customerFactory  = $customerFactory;

        parent::__construct($context);
    }

    public function execute()
    {

        
        // Get Website ID
        
        die('test');

        /*$websiteId  = $this->storeManager->getWebsite()->getWebsiteId();

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customer = $objectManager->create('Magento\Customer\Model\Customer')->load(2);
    


        
        $customer->setEmail("test@gmail.com"); 
        
        $customer->setPassword("store@123"); 

        
        $customer->save();*/
        
    }
}