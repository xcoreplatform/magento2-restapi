<?php

namespace Dealer4dealer\Xcore\Controller\Adminhtml\CustomAttribute;

class Edit extends \Magento\Backend\App\Action
{

    /**
     * Page factory
     *
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;

    /**
     * Result JSON factory
     *
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $_resultJsonFactory;

    /**
     * Constructor
     *
     * @param \Magento\Backend\Model\Session $backendSession
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
     * @param \Dealer4dealer\Xcore\Model\CustomAttributeFactory $customAttributeFactory
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Backend\Model\View\Result\RedirectFactory $resultRedirectFactory
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Dealer4dealer\Xcore\Model\CustomAttributeFactory $customAttributeFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
    }
    /**
     * Is action allowed
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Dealer4dealer_Xcore::custom_attributes');
    }
    /**
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        /** @var \Dealer4dealer\Xcore\Model\CustomAttribute $customAttribute */
        $customAttribute = $this->_initCustomAttribute();
        /** @var \Magento\Backend\Model\View\Result\Page|\Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Dealer4dealer_Xcore::custom_attributes');
        $resultPage->getConfig()->getTitle()->set(__('Custom Attributes'));
        if ($id) {
            $customAttribute->load($id);
            if (!$customAttribute->getId()) {
                $this->messageManager->addError(__('This Custom Attribute no longer exists.'));
                $resultRedirect = $this->_resultRedirectFactory->create();
                $resultRedirect->setPath(
                    'dealer4dealer_xcore/*/edit',
                    [
                        'id' => $customAttribute->getId(),
                        '_current' => true
                    ]
                );
                return $resultRedirect;
            }
        }
        $title = $customAttribute->getId() ? $customAttribute->getFrom() : __('New Custom Attribute');
        $resultPage->getConfig()->getTitle()->prepend($title);
        $data = $this->_backendSession->getData('dealer4dealer_xcore_custom_attribute_data', true);
        if (!empty($data)) {
            $customAttribute->setData($data);
        }
        return $resultPage;
    }
}