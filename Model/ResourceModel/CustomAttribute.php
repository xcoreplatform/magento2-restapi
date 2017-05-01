<?php
namespace Dealer4dealer\Xcore\Model\ResourceModel;


class CustomAttribute extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Date model
     *
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $_date;

    /**
     * constructor
     *
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $date
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     */
    public function __construct(
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        $this->_date = $date;
        parent::__construct($context);
    }


    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('dealer4dealer_xcore_custom_attribute', 'id');
    }

    /**
     * Retrieves Custom Attribute from DB by passed id.
     *
     * @param string $id
     * @return string|bool
     */
    public function getCustomAttributeById($id)
    {
        $adapter = $this->getConnection();
        $select = $adapter->select()
            ->from($this->getMainTable())
            ->where('id = :id');
        $binds = ['id' => (int)$id];
        return $adapter->fetchOne($select, $binds);
    }
    /**
     * Before save callback
     *
     * @param \Magento\Framework\Model\AbstractModel|\Dealer4dealer\Xcore\Model\CustomAttribute $object
     * @return $this
     */
    protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
    {
        $object->setUpdatedAt($this->_date->date());
        if ($object->isObjectNew()) {
            $object->setCreatedAt($this->_date->date());
        }
        return parent::_beforeSave($object);
    }
}