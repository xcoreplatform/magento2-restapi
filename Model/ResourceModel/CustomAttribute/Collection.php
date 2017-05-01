<?php
namespace Dealer4dealer\Xcore\Model\ResourceModel\CustomAttribute;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * ID Field Name
     *
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * Event prefix
     *
     * @var string
     */
    protected $_eventPrefix = 'dealer4dealer_xcore_custom_attribute_collection';

    /**
     * Event object
     *
     * @var string
     */
    protected $_eventObject = 'custom_attribute_collection';

    /**
     * Define resource model
     *
     * @return void
     */

    protected function _construct()
    {
        $this->_init('Dealer4dealer\Xcore\Model\CustomAttribute', 'Dealer4dealer\Xcore\Model\ResourceModel\CustomAttribute');
    }

    /**
     * Get SQL for get record count.
     * Extra GROUP BY strip added.
     *
     * @return \Magento\Framework\DB\Select
     */
    public function getSelectCountSql()
    {
        $countSelect = parent::getSelectCountSql();
        $countSelect->reset(\Zend_Db_Select::GROUP);
        return $countSelect;
    }

    /**
     * @param string $valueField
     * @param string $labelField
     * @param array $additional
     * @return array
     */
    protected function _toOptionArray($valueField = 'id', $labelField = 'from', $additional = [])
    {
        return parent::_toOptionArray($valueField, $labelField, $additional);
    }
}