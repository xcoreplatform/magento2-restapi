<?php

namespace Dealer4dealer\Xcore\Controller\Adminhtml\CustomOrderAttribute;

class Save extends \Dealer4dealer\Xcore\Controller\Adminhtml\CustomAttribute\Save
{

    public function getType()
    {
        return 'order';
    }
}