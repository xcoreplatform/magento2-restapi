<?php

namespace Dealer4dealer\Xcore\Controller\Adminhtml;

abstract class CustomAttribute extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Dealer4dealer_Xcore::top_level';
    protected $_coreRegistry;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function initPage($resultPage)
    {
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE)
            ->addBreadcrumb(__('Dealer4dealer'), __('Dealer4dealer'))
            ->addBreadcrumb(__('Customattribute'), __('Customattribute'));
        return $resultPage;
    }

}
