<?php

namespace Dealer4dealer\Xcore\Model;

/**
 * Class used to store the data send with the post request.
 *
 * Class Data
 * @package Dealer4dealer\Xcore\Model
 */
class PriceListData
{
    public $batchNumber;
    public $priceListId;
    public $startDate;
    public $endDate;
    public $allGroups;
    public $customerGroupIds;
    public $websiteIds;
    /** @var PriceListTierPrice[] */
    public $items = [];

    /**
     * @return integer
     */
    public function getBatchNumber()
    {
        return $this->batchNumber;
    }

    /**
     * @return string
     */
    public function getPriceListId()
    {
        return $this->priceListId;
    }

    /**
     * @return string
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @return string
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @return boolean
     */
    public function getAllGroups()
    {
        return $this->allGroups;
    }

    /**
     * @return integer[]
     */
    public function getCustomerGroupIds()
    {
        return $this->customerGroupIds;
    }

    /**
     * @return integer[]
     */
    public function getWebsiteIds()
    {
        return $this->websiteIds;
    }

    /**
     * @return PriceListTierPrice[]
     */
    public function getItems():array
    {
        return $this->items;
    }

    /**
     * @param integer $batchNumber
     * @return PriceListData
     */
    public function setBatchNumber($batchNumber)
    {
        $this->batchNumber = $batchNumber;
        return $this;
    }

    /**
     * @param string $priceListId
     * @return PriceListData
     */
    public function setPriceListId($priceListId)
    {
        $this->priceListId = $priceListId;
        return $this;
    }

    /**
     * @param string $startDate
     * @return PriceListData
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * @param string $endDate
     * @return PriceListData
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * @param string $customerGroupIds
     * @return PriceListData
     */
    public function setCustomerGroupIds($customerGroupIds)
    {
        if ($customerGroupIds == null) {
            $this->allGroups        = true;
            $this->customerGroupIds = ['0'];
        } else {
            $this->allGroups        = false;
            $array                  = explode(',', $customerGroupIds);
            $this->customerGroupIds = $array;
        }

        return $this;
    }

    /**
     * @param string $websiteIds
     * @return PriceListData
     */
    public function setWebsiteIds($websiteIds)
    {
        if ($websiteIds == null) {
            $this->websiteIds = ['0'];
        } else {
            $array            = explode(',', $websiteIds);
            $this->websiteIds = $array;
        }

        return $this;
    }

    /**
     * @param PriceListTierPrice[] $items
     * @return PriceListData
     */
    public function setItems(array $items):PriceListData
    {
        $this->items = $items;
        return $this;
    }

    /**
     * @param PriceListTierPrice $item
     * @return PriceListData
     */
    public function addItem($item):PriceListData
    {
        $this->items[] = $item;
        return $this;
    }
}