<?php

namespace Dealer4dealer\Xcore\Controller\Adminhtml\CustomInvoiceAttribute;

class Save extends \Dealer4dealer\Xcore\Controller\Adminhtml\CustomAttribute\Save
{

    public function getType()
    {
        return 'invoice';
    }
}