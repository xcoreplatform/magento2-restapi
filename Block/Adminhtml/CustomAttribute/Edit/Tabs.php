<?php

namespace Dealer4dealer\Xcore\Block\Adminhtml\CustomAttribute\Edit;

/**
 * @method Tabs setTitle(\string $title)
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('custom_attribute_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Custom Attribute Information'));
    }
}