<?php
namespace Escorpien\Gourl\Model\ResourceModel;

class Coin extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('coin', 'coin_id');
    }
}
?>