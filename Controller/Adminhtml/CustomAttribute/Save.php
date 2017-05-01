<?php

namespace Dealer4dealer\Xcore\Controller\Adminhtml\CustomAttribute;

class Save extends \Magento\Backend\App\Action
{

    /**
     * Constructor
     *
     * @param \Magento\Backend\Model\Session $backendSession
     * @param \Dealer4dealer\Xcore\Model\CustomAttributeFactory $customAttributeFactory
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Backend\Model\View\Result\RedirectFactory $resultRedirectFactory
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Dealer4dealer\Xcore\Model\CustomAttributeFactory $customAttributeFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->_backendSession = $backendSession;
        parent::__construct($context);
    }
    /**
     * Run the action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $data = $this->getRequest()->getCustomAttribute('custom_attribute');
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $customAttribute = $this->_initCustomAttribute();
            $customAttribute->setData($data);
            $this->_eventManager->dispatch(
                'dealer4dealer_xcore_custom_attribute_prepare_save',
                [
                    'custom_attribute' => $customAttribute,
                    'request' => $this->getRequest()
                ]
            );
            try {
                $customAttribute->save();
                $this->messageManager->addSuccess(__('The Custom Attribute has been saved.'));
                $this->_backendSession->setDealer4dealerXcoreCustomAttributeData(false);
                if ($this->getRequest()->getParam('back')) {
                    $resultRedirect->setPath(
                        'dealer4dealer_xcore/*/edit',
                        [
                            'id' => $customAttribute->getId(),
                            '_current' => true
                        ]
                    );
                    return $resultRedirect;
                }
                $resultRedirect->setPath('dealer4dealer_xcore/*/');
                return $resultRedirect;
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the Custom Attribute.'));
            }
            $this->_getSession()->setDealer4dealerXcoreCustomAttributeData($data);
            $resultRedirect->setPath(
                'dealer4dealer_xcore/*/edit',
                [
                    'id' => $customAttribute->getId(),
                    '_current' => true
                ]
            );
            return $resultRedirect;
        }
        $resultRedirect->setPath('dealer4dealer_xcore/*/');
        return $resultRedirect;
    }

}