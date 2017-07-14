<?php

namespace Dealer4dealer\Xcore\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class PriceListCustomerGroupWebsite extends AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('dealer4dealer_xcore_price_list_customer_group_website', 'id');
    }
}