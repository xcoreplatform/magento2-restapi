<?php

namespace Dealer4dealer\Xcore\Model\ResourceModel;

class PriceListItem extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('dealer4dealer_price_list_item', 'id');
    }
}
