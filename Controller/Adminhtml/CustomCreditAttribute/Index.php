<?php

namespace Dealer4dealer\Xcore\Controller\Adminhtml\CustomCreditAttribute;

class Index extends \Dealer4dealer\Xcore\Controller\Adminhtml\CustomAttribute\Index
{

    protected function getPageTitle()
    {
        return 'Custom Credit Attributes';
    }

    protected function getActiveMenu()
    {
        return 'Dealer4dealer_Xcore::custom_credit_attributes';
    }

}