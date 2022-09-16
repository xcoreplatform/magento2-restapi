<?php

namespace Dealer4dealer\Xcore\Model\ResourceModel\PriceList;

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
            \Dealer4dealer\Xcore\Model\PriceList::class,
            \Dealer4dealer\Xcore\Model\ResourceModel\PriceList::class
        );
    }
}
