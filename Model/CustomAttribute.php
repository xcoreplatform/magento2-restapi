<?php

namespace Dealer4dealer\Xcore\Model;

use Dealer4dealer\Xcore\Api\Data\CustomAttributeInterface;

class CustomAttribute extends \Magento\Framework\Model\AbstractModel implements CustomAttributeInterface
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Dealer4dealer\Xcore\Model\ResourceModel\CustomAttribute');
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getData(self::CUSTOMATTRIBUTE_ID);
    }

    /**
     * {@inheritdoc}
     */
    public function setId($customattributeId)
    {
        return $this->setData(self::CUSTOMATTRIBUTE_ID, $customattributeId);
    }

    /**
     * {@inheritdoc}
     */
    public function getFrom()
    {
        return $this->getData(self::FROM);
    }

    /**
     * {@inheritdoc}
     */
    public function setFrom($from)
    {
        return $this->setData(self::FROM, $from);
    }

    /**
     * {@inheritdoc}
     */
    public function getTo()
    {
        return $this->getData(self::TO);
    }

    /**
     * {@inheritdoc}
     */
    public function setTo($to)
    {
        return $this->setData(self::TO, $to);
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return $this->getData(self::TYPE);
    }

    /**
     * {@inheritdoc}
     */
    public function setType($type)
    {
        return $this->setData(self::TYPE, $type);
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt($created_at)
    {
        return $this->setData(self::CREATED_AT, $created_at);
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * {@inheritdoc}
     */
    public function setUpdatedAt($updated_at)
    {
        return $this->setData(self::UPDATED_AT, $updated_at);
    }
}
