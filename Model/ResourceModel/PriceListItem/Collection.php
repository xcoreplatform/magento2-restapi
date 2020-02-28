<?php

namespace Dealer4dealer\Xcore\Model\ResourceModel\PriceListItem;

use Dealer4dealer\Xcore\Model\PriceListItem;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            PriceListItem::class,
            \Dealer4dealer\Xcore\Model\ResourceModel\PriceListItem::class
        );
    }
}
