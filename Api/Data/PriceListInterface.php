<?php

namespace Dealer4dealer\Xcore\Api\Data;

interface PriceListInterface
{
    const ID            = 'id';
    const PRICE_LIST_ID = 'price_list_id';
    const START_DATE    = 'start_date';
    const END_DATE      = 'end_date';

    /**
     * Get id
     * @return string|null
     */
    public function getId();

    /**
     * Set id
     * @param string $id
     * @return PriceListInterface
     */
    public function setId($id);

    /**
     * Get price_list_id
     * @return string|null
     */
    public function getPriceListId();

    /**
     * Set price_list_id
     * @param string $priceListId
     * @return PriceListInterface
     */
    public function setPriceListId($priceListId);

    /**
     * Get start_date
     * @return string|null
     */
    public function getStartDate();

    /**
     * Set start_date
     * @param string $startDate
     * @return PriceListInterface
     */

    public function setStartDate($startDate);

    /**
     * Get end_date
     * @return string|null
     */
    public function getEndDate();

    /**
     * Set to_date
     * @param string $endDate
     * @return PriceListInterface
     */
    public function setEndDate($endDate);
}