<?php

namespace Dealer4dealer\Xcore\Model;

/**
* @method CustomAttribute setFrom($from)
* @method CustomAttribute setTo($to)
* @method string getFrom()
* @method string getTo()
* @method CustomAttribute setCreatedAt(\string $createdAt)
* @method string getCreatedAt()
* @method CustomAttribute setUpdatedAt(\string $updatedAt)
* @method string getUpdatedAt()
*/
class CustomAttribute extends \Magento\Framework\Model\AbstractModel
{
    /**
    * Cache tag
    *
    * @var string
    */
    const CACHE_TAG = 'dealer4dealer_xcore_custom_attribute';

    /**
    * Cache tag
    *
    * @var string
    */
    protected $_cacheTag = 'dealer4dealer_xcore_custom_attribute';

    /**
    * Event prefix
    *
    * @var string
    */
    protected $_eventPrefix = 'dealer4dealer_xcore_custom_attribute';

    /**
    * Initialize resource model
    *
    * @return void
    */
    protected function _construct()
    {
        $this->_init('Dealer4dealer\Xcore\Model\ResourceModel\CustomAttribute');
    }

    /**
    * Get identities
    *
    * @return array
    */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
    * get entity default values
    *
    * @return array
    */
    public function getDefaultValues()
    {
        $values = [];
        return $values;
    }
}