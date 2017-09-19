<?php


namespace Dealer4dealer\Xcore\Model\ResourceModel;

class CustomAttribute extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('dealer4dealer_xcore_custom_attribute', 'id');
    }
}
