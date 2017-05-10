<?php


namespace Dealer4dealer\Xcore\Model;

class CustomAttributeManagement
{

    /**
     * {@inheritdoc}
     */
    public function getCustomAttribute($param)
    {
        return 'hello api GET return the $param ' . $param;
    }
}