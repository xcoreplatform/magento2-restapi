<?php

namespace Dealer4dealer\Xcore\Controller\Adminhtml\CustomAttribute;

abstract class Index extends \Dealer4dealer\Xcore\Controller\Adminhtml\CustomAttribute
{

    /**
     * Execute the action
     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        if($this->getRequest()->getQuery('ajax')) {
            $resultForward = $this->resultForwardFactory->create();
            $resultForward->forward('grid');
            return $resultForward;
        }

        $resultPage = $this->resultPageFactory->create();

        $resultPage->setActiveMenu($this->getActiveMenu());

        $resultPage->getConfig()->getTitle()->prepend((__($this->getPageTitle())));

//        $resultPage->addHandle('xcore_customProductAttribute_index'); //loads the layout of module_custom_customlayout.xml file with its name

        return $resultPage;
    }

    protected abstract function getPageTitle();
    protected abstract function getActiveMenu();

}