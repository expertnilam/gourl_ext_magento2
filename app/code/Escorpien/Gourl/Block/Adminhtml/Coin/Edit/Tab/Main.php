<?php

namespace Escorpien\Gourl\Block\Adminhtml\Coin\Edit\Tab;

/**
 * Coin edit form main tab
 */
class Main extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @var \Escorpien\Gourl\Model\Status
     */
    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \Escorpien\Gourl\Model\Status $status,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        $this->_status = $status;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm()
    {
        /* @var $model \Escorpien\Gourl\Model\BlogPosts */
        $model = $this->_coreRegistry->registry('coin');

        $isElementDisabled = false;

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Item Information')]);

        if ($model->getId()) {
            $fieldset->addField('coin_id', 'hidden', ['name' => 'coin_id']);
        }

		
        /*$fieldset->addField(
            'coin_id',
            'text',
            [
                'name' => 'coin_id',
                'label' => __('Id'),
                'title' => __('Id'),
				'required' => true,
                'disabled' => $isElementDisabled
            ]
        );*/


        $fieldset->addField(
            'enabled',
            'select',
            [
                'name' => 'enabled',
                'label' => __('Enabled'),
                'title' => __('Enabled'),
                'required' => true,
                'disabled' => $isElementDisabled,
                'options' => array(2=>'Disabled',1=>'Enabled')
            ]
        );
					
        $fieldset->addField(
            'name',
            'select',
            [
                'name' => 'name',
                'label' => __('Name'),
                'title' => __('Name'),
				'required' => true,
                'disabled' => $isElementDisabled,
                'options' => array(
                    'bitcoin'=>'Bitcoin',
                    'bitcoincash'=>'Bitcoincash',
                    'litecoin'=>'Litecoin',
                    'dash'=>'Dash',
                    'dogecoin'=>'Dogecoin',
                    'speedcoin'=>'Speedcoin',
                    'reddcoin'=>'Reddcoin',
                    'potcoin'=>'Potcoin',
                    'feathercoin'=>'Feathercoin',
                    'vertcoin'=>'Vertcoin',
                    'peercoin'=>'Peercoin',
                    'monetaryunit'=>'Monetaryunit',
                    
                )
            ]
        );
					
        $fieldset->addField(
            'public_key',
            'text',
            [
                'name' => 'public_key',
                'label' => __('Public Key'),
                'title' => __('Public Key'),
				'required' => true,
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'private_key',
            'text',
            [
                'name' => 'private_key',
                'label' => __('Private Key'),
                'title' => __('Private Key'),
				'required' => true,
                'disabled' => $isElementDisabled
            ]
        );
					

        if (!$model->getId()) {
            $model->setData('is_active', $isElementDisabled ? '0' : '1');
        }

        $form->setValues($model->getData());
        $this->setForm($form);
		
        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Item Information');
    }

    /**
     * Prepare title for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Item Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
    
    public function getTargetOptionArray(){
    	return array(
    				'_self' => "Self",
					'_blank' => "New Page",
    				);
    }
}
