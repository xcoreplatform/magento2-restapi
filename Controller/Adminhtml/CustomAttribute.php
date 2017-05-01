<?php

namespace Dealer4dealer\Xcore\Controller\Adminhtml;

abstract class CustomAttribute extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;
    protected $resultForwardFactory;
    protected $resultRedirectFactory;

    /**
     * Constructor
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Backend\View\Result\ForwardFactory $resultForwardFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
    )
    {
        $this->resultPageFactory        = $resultPageFactory;
        $this->resultForwardFactory     = $resultForwardFactory;
        $this->resultRedirectFactory     = $context->getResultRedirectFactory();
        parent::__construct($context);
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Dealer4dealer_Xcore::xcore');
    }

    protected function __initAction()
    {
        $this->_view->loadLayout();
        return $this;
    }

//    /**
//     * Init Custom Attribute
//     *
//     * @return \Dealer4dealer\Xcore\Model\CustomAttribute
//     */
//    protected function _initCustomAttribute()
//    {
//        $customAttributeId  = (int) $this->getRequest()->getParam('id');
//        /** @var \Dealer4dealer\Xcore\Model\CustomAttribute $customAttribute */
//        $customAttribute    = $this->_customAttributeFactory->create();
//        if ($customAttributeId) {
//            $customAttribute->load($customAttributeId);
//        }
//        $this->_coreRegistry->register('dealer4dealer_xcore_custom_attribute', $customAttribute);
//        return $customAttribute;
//    }
}