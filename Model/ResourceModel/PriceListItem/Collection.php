<?php

namespace Dealer4dealer\Xcore\Model\ResourceModel\PriceListItem;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Dealer4dealer\Xcore\Model\PriceListItem::class,
            \Dealer4dealer\Xcore\Model\ResourceModel\PriceListItem::class
        );
    }
}
