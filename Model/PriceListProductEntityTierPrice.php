<?php

namespace Dealer4dealer\Xcore\Model;

use Dealer4dealer\Xcore\Api\Data\PriceListProductEntityTierPriceInterface;
use Magento\Framework\Model\AbstractModel;

class PriceListProductEntityTierPrice extends AbstractModel implements PriceListProductEntityTierPriceInterface
{

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Dealer4dealer\Xcore\Model\ResourceModel\PriceListProductEntityTierPrice');
    }

    /**
     * Get id
     * @return string
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * Set id
     * @param string $id
     * @return PriceListProductEntityTierPriceInterface
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Get price_list_id
     * @return string
     */
    public function getPriceListId()
    {
        return $this->getData(self::PRICE_LIST_ID);
    }

    /**
     * Set price_list_id
     * @param string $priceListId
     * @return PriceListProductEntityTierPriceInterface
     */
    public function setPriceListId($priceListId)
    {
        return $this->setData(self::PRICE_LIST_ID, $priceListId);
    }

    /**
     * Get product_id
     * @return string
     */
    public function getProductId()
    {
        return $this->getData(self::PRODUCT_ID);
    }

    /**
     * Set product_id
     * @param string $productId
     * @return PriceListProductEntityTierPriceInterface
     */
    public function setProductId($productId)
    {
        return $this->setData(self::PRODUCT_ID, $productId);
    }

    /**
     * Get qty
     * @return string
     */
    public function getQty()
    {
        return $this->getData(self::QTY);
    }

    /**
     * Set qty
     * @param string $qty
     * @return PriceListProductEntityTierPriceInterface
     */
    public function setQty($qty)
    {
        return $this->setData(self::QTY, $qty);
    }

    /**
     * Get value
     * @return string
     */
    public function getValue()
    {
        return $this->getData(self::VALUE);
    }

    /**
     * Set value
     * @param string $value
     * @return PriceListProductEntityTierPriceInterface
     */
    public function setValue($value)
    {
        return $this->setData(self::VALUE, $value);
    }
}