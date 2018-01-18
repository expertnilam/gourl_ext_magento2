<?php
namespace Escorpien\Gourl\Model;

class Coin extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Escorpien\Gourl\Model\ResourceModel\Coin');
    }
}
?>