<?php

namespace Dealer4dealer\Xcore\Controller\Adminhtml\CustomOrderAttribute;

class Index extends \Dealer4dealer\Xcore\Controller\Adminhtml\CustomAttribute\Index
{

    protected function getPageTitle()
    {
        return 'Custom Order Attributes';
    }

    protected function getActiveMenu()
    {
        return 'Dealer4dealer_Xcore::custom_order_attributes';
    }

}