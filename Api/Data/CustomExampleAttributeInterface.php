<?php


namespace Dealer4dealer\Xcore\Api\Data;

interface CustomExampleAttributeInterface
{

    const FROM = 'from';
    const TYPE = 'type';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const CUSTOMEXAMPLEATTRIBUTE_ID = 'id';
    const TO = 'to';


    /**
     * Get id
     * @return string|null
     */
    
    public function getId();

    /**
     * Set id
     * @param string $customexampleattribute_id
     * @return Dealer4dealer\Xcore\Api\Data\CustomExampleAttributeInterface
     */
    
    public function setId($customexampleattributeId);

    /**
     * Get from
     * @return string|null
     */
    
    public function getFrom();

    /**
     * Set from
     * @param string $from
     * @return Dealer4dealer\Xcore\Api\Data\CustomExampleAttributeInterface
     */
    
    public function setFrom($from);

    /**
     * Get to
     * @return string|null
     */
    
    public function getTo();

    /**
     * Set to
     * @param string $to
     * @return Dealer4dealer\Xcore\Api\Data\CustomExampleAttributeInterface
     */
    
    public function setTo($to);

    /**
     * Get type
     * @return string|null
     */
    
    public function getType();

    /**
     * Set type
     * @param string $type
     * @return Dealer4dealer\Xcore\Api\Data\CustomExampleAttributeInterface
     */
    
    public function setType($type);

    /**
     * Get created_at
     * @return string|null
     */
    
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $created_at
     * @return Dealer4dealer\Xcore\Api\Data\CustomExampleAttributeInterface
     */
    
    public function setCreatedAt($created_at);

    /**
     * Get updated_at
     * @return string|null
     */
    
    public function getUpdatedAt();

    /**
     * Set updated_at
     * @param string $updated_at
     * @return Dealer4dealer\Xcore\Api\Data\CustomExampleAttributeInterface
     */
    
    public function setUpdatedAt($updated_at);
}
