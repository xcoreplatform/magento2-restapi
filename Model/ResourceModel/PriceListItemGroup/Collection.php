<?php

namespace Dealer4dealer\Xcore\Model\ResourceModel\PriceListItemGroup;

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
            \Dealer4dealer\Xcore\Model\PriceListItemGroup::class,
            \Dealer4dealer\Xcore\Model\ResourceModel\PriceListItemGroup::class
        );
    }
}
