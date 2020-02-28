<?php

namespace Dealer4dealer\Xcore\Model\ResourceModel\PriceList;

use Dealer4dealer\Xcore\Model\PriceList;
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
            PriceList::class,
            \Dealer4dealer\Xcore\Model\ResourceModel\PriceList::class
        );
    }
}
