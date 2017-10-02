<?php

namespace Dealer4dealer\Xcore\Controller\Adminhtml\CustomInvoiceAttribute;

class Index extends \Dealer4dealer\Xcore\Controller\Adminhtml\CustomAttribute\Index
{


    protected function getPageTitle()
    {
        return 'Custom Invoice Attributes';
    }

    protected function getActiveMenu()
    {
        return 'Dealer4dealer_Xcore::custom_invoice_attributes';
    }


}