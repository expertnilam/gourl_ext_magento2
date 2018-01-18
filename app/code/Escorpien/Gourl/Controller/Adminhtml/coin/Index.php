<?php

namespace Escorpien\Gourl\Controller\Adminhtml\coin;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPagee;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return void
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Escorpien_Gourl::coin');
        $resultPage->addBreadcrumb(__('Escorpien'), __('Escorpien'));
        $resultPage->addBreadcrumb(__('Manage item'), __('Manage Coin'));
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Coin'));

        return $resultPage;
    }
}
?>