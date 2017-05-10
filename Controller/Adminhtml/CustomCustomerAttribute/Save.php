<?php

namespace Dealer4dealer\Xcore\Controller\Adminhtml\CustomCustomerAttribute;

class Save extends \Dealer4dealer\Xcore\Controller\Adminhtml\CustomAttribute\Save
{

    public function getType()
    {
        return 'customer';
    }
}