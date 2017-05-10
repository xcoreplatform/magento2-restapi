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
     * Get id
     * @return string
     */
    public function getId()
    {
        return $this->getData(self::CUSTOMATTRIBUTE_ID);
    }

    /**
     * Set id
     * @param string $customattributeId
     * @return Dealer4dealer\Xcore\Api\Data\CustomAttributeInterface
     */
    public function setId($customattributeId)
    {
        return $this->setData(self::CUSTOMATTRIBUTE_ID, $customattributeId);
    }

    /**
     * Get from
     * @return string
     */
    public function getFrom()
    {
        return $this->getData(self::FROM);
    }

    /**
     * Set from
     * @param string $from
     * @return Dealer4dealer\Xcore\Api\Data\CustomAttributeInterface
     */
    public function setFrom($from)
    {
        return $this->setData(self::FROM, $from);
    }

    /**
     * Get to
     * @return string
     */
    public function getTo()
    {
        return $this->getData(self::TO);
    }

    /**
     * Set to
     * @param string $to
     * @return Dealer4dealer\Xcore\Api\Data\CustomAttributeInterface
     */
    public function setTo($to)
    {
        return $this->setData(self::TO, $to);
    }

    /**
     * Get type
     * @return string
     */
    public function getType()
    {
        return $this->getData(self::TYPE);
    }

    /**
     * Set type
     * @param string $type
     * @return Dealer4dealer\Xcore\Api\Data\CustomAttributeInterface
     */
    public function setType($type)
    {
        return $this->setData(self::TYPE, $type);
    }

    /**
     * Get created_at
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Set created_at
     * @param string $created_at
     * @return Dealer4dealer\Xcore\Api\Data\CustomAttributeInterface
     */
    public function setCreatedAt($created_at)
    {
        return $this->setData(self::CREATED_AT, $created_at);
    }

    /**
     * Get updated_at
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * Set updated_at
     * @param string $updated_at
     * @return Dealer4dealer\Xcore\Api\Data\CustomAttributeInterface
     */
    public function setUpdatedAt($updated_at)
    {
        return $this->setData(self::UPDATED_AT, $updated_at);
    }
}
