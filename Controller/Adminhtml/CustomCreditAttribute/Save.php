<?php

namespace Dealer4dealer\Xcore\Controller\Adminhtml\CustomCreditAttribute;

class Save extends \Dealer4dealer\Xcore\Controller\Adminhtml\CustomAttribute\Save
{

    public function getType()
    {
        return 'credit';
    }
}