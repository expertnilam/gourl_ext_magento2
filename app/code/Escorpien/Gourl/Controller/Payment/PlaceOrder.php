<?php
/**
 * Escorpien PlaceOrder controller
 *
 * @category    Escorpien
 * @package     Escorpien_Gourl
 * @author      Escorpien
 * @copyright   Escorpien (https://gourl.io)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
namespace Escorpien\Gourl\Controller\Payment;

use Escorpien\Gourl\Model\Payment as GourlPayment;
use Magento\Checkout\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Sales\Model\OrderFactory;
use Magento\Framework\Controller\ResultFactory;


class PlaceOrder extends Action
{
    protected $orderFactory;
    protected $gourlPayment;
    protected $checkoutSession;

    /**
     * @param Context $context
     * @param OrderFactory $orderFactory
     * @param Session $checkoutSession
     * @param GourlPayment $gourlPayment
     */
    public function __construct(
        Context $context,
        OrderFactory $orderFactory,
        Session $checkoutSession,
        GourlPayment $gourlPayment
    )
    {
        parent::__construct($context);

        $this->orderFactory = $orderFactory;
        $this->gourlPayment = $gourlPayment;
        $this->checkoutSession = $checkoutSession;
    }

    public function execute()
    {
        $id = $this->checkoutSession->getLastOrderId();

        $order = $this->orderFactory->create()->load($id);

        if (!$order->getIncrementId()) {
            $this->getResponse()->setBody(json_encode(array(
                'status' => false,
                'reason' => 'Order Not Found',
            )));
            return;
        }
        


        $result = array(
            'status' => 'redirect',
            'payment_url' =>  $this->_url->getUrl('gourl/index/display'),
            'order_increment_id' => $order->getIncrementId(),
        );

        $this->getResponse()->setBody(json_encode($result));

        return;


    }
}
