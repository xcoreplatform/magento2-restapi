<?php

namespace Dealer4dealer\Xcore\Model\ResourceModel\PriceListCustomerGroupWebsite;

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
            'Dealer4dealer\Xcore\Model\PriceListCustomerGroupWebsite',
            'Dealer4dealer\Xcore\Model\ResourceModel\PriceListCustomerGroupWebsite'
        );
    }
}