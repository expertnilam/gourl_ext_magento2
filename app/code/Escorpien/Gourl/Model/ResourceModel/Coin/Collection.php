<?php

namespace Escorpien\Gourl\Model\ResourceModel\Coin;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Escorpien\Gourl\Model\Coin', 'Escorpien\Gourl\Model\ResourceModel\Coin');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>