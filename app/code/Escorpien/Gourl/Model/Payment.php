<?php
 
namespace Escorpien\Gourl\Model;



/*use Escorpien\Gourl as CoinGateMerchant;*/
use Magento\Directory\Model\CountryFactory;
use Magento\Framework\Api\AttributeValueFactory;
use Magento\Framework\Api\ExtensionAttributesFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Response\Http;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Module\ModuleListInterface;
use Magento\Framework\Registry;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Magento\Framework\UrlInterface;
use Magento\Payment\Helper\Data;
use Magento\Payment\Model\Method\AbstractMethod;
use Magento\Payment\Model\Method\Logger;
use Magento\Sales\Model\Order;
use Magento\Store\Model\StoreManagerInterface;



/**
 * Pay In Store payment method model
 */
class Payment extends \Magento\Payment\Model\Method\AbstractMethod
{
 
    /**
     * Payment code
     *
     * @var string
     */
    protected $_code = 'escorpien_gourl';
    protected $_isInitializeNeeded = true;
	protected $urlBuilder;
    protected $coingate;
    protected $storeManager;




    
    public function __construct(
        Context $context,
        Registry $registry,
        ExtensionAttributesFactory $extensionFactory,
        AttributeValueFactory $customAttributeFactory,
        Data $paymentData,
        ScopeConfigInterface $scopeConfig,
        Logger $logger,
        /*CoinGateMerchant $coingate,*/
        UrlInterface $urlBuilder,
        StoreManagerInterface $storeManager,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = array()
    )
    {
        parent::__construct(
            $context,
            $registry,
            $extensionFactory,
            $customAttributeFactory,
            $paymentData,
            $scopeConfig,
            $logger,
            $resource,
            $resourceCollection,
            $data
        );

        $this->urlBuilder = $urlBuilder;
        /*$this->coingate = $coingate;*/
        $this->storeManager = $storeManager;

        /*$this->coingate->initialize(array(
            'app_id' => $this->getConfigData('app_id'),
            'api_key' => $this->getConfigData('api_key'),
            'api_secret' => $this->getConfigData('api_secret'),
            'mode' => $this->getConfigData('sandbox_mode') ? 'sandbox' : 'live',
            'user_agent' => 'CoinGate - Magento 2 Extension v' . self::COINGATE_MAGENTO_VERSION
        ));*/
    }


	public function getCoinGateRequest(Order $order)
    {
        $token = substr(md5(rand()), 0, 32);

        $payment = $order->getPayment();
        $payment->setAdditionalInformation('coingate_order_token', $token);
        $payment->save();

        $description = array();
        foreach ($order->getAllItems() as $item) {
            $description[] = number_format($item->getQtyOrdered(), 0) . ' × ' . $item->getName();
        }

        $params = array(
            'order_id' => $order->getIncrementId(),
            'price' => number_format($order->getGrandTotal(), 2, '.', ''),
            'currency' => $order->getOrderCurrencyCode(),
            'receive_currency' => $this->getConfigData('receive_currency'),
            'callback_url' => ($this->urlBuilder->getUrl('coingate/payment/callback') . '?token=' . $payment->getAdditionalInformation('coingate_order_token')),
            'cancel_url' => $this->urlBuilder->getUrl('checkout/onepage/failure'),
            'success_url' => $this->urlBuilder->getUrl('checkout/onepage/success'),
            'title' => $this->storeManager->getWebsite()->getName(),
            'description' => join($description, ', ')
        );

        $this->coingate->createOrder($params);

        if ($this->coingate->success) {
            return array(
                'status' => true,
                'payment_url' => $this->coingate->response['payment_url']
            );
        } else {
            return array(
                'status' => false
            );
        }
    }
}