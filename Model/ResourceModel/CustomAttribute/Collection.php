<?php


namespace Dealer4dealer\Xcore\Model\ResourceModel\CustomAttribute;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    protected $_idFieldName = 'id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'Dealer4dealer\Xcore\Model\CustomAttribute',
            'Dealer4dealer\Xcore\Model\ResourceModel\CustomAttribute'
        );
    }
}
