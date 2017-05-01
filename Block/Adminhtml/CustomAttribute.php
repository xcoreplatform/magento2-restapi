<?php

namespace Dealer4dealer\Xcore\Block\Adminhtml;

class CustomAttribute extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml';
        $this->_blockGroup = 'Dealer4dealer_Xcore';
        $this->_headerText = __('Custom Attributes');
        $this->_addButtonLabel = __('Create New Custom Attribute');
        parent::_construct();
    }
}