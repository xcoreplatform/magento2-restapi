<?php

namespace Dealer4dealer\Xcore\Api\Data;

interface CustomAttributeInterface
{
    const CUSTOMATTRIBUTE_ID = 'id';
    const FROM = 'from';
    const TO = 'to';
    const TYPE = 'type';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * Get id
     *
     * @return string|null
     */
    public function getId();

    /**
     * Set id
     *
     * @param string $customattributeId
     * @return \Dealer4dealer\Xcore\Api\Data\CustomAttributeInterface
     */
    public function setId($customattributeId);

    /**
     * Get from
     *
     * @return string|null
     */
    public function getFrom();

    /**
     * Set from
     *
     * @param string $from
     * @return \Dealer4dealer\Xcore\Api\Data\CustomAttributeInterface
     */
    public function setFrom($from);

    /**
     * Get to
     *
     * @return string|null
     */
    public function getTo();

    /**
     * Set to
     *
     * @param string $to
     * @return \Dealer4dealer\Xcore\Api\Data\CustomAttributeInterface
     */
    public function setTo($to);

    /**
     * Get type
     *
     * @return string|null
     */
    public function getType();

    /**
     * Set type
     *
     * @param string $type
     * @return \Dealer4dealer\Xcore\Api\Data\CustomAttributeInterface
     */
    public function setType($type);

    /**
     * Get created_at
     *
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     *
     * @param string $created_at
     * @return \Dealer4dealer\Xcore\Api\Data\CustomAttributeInterface
     */
    public function setCreatedAt($created_at);

    /**
     * Get updated_at
     *
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set updated_at
     * @param string $updated_at
     * @return \Dealer4dealer\Xcore\Api\Data\CustomAttributeInterface
     */
    public function setUpdatedAt($updated_at);
}
