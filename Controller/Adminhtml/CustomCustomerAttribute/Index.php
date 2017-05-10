<?php

namespace Dealer4dealer\Xcore\Controller\Adminhtml\CustomCustomerAttribute;

class Index extends \Dealer4dealer\Xcore\Controller\Adminhtml\CustomAttribute\Index
{

    protected function getPageTitle()
    {
        return 'Custom Customer Attributes';
    }

    protected function getActiveMenu()
    {
        return 'Dealer4dealer_Xcore::custom_customer_attributes';
    }

}