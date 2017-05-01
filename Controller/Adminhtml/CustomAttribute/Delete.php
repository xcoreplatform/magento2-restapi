<?php

namespace Dealer4dealer\Xcore\Controller\Adminhtml\CustomAttribute;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * Execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $resultRedirect = $this->_resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            $name = "";
            try {
                /** @var \Dealer4dealer\Xcore\Model\CustomAttribute $customAttribute */
                $customAttribute = $this->_customAttributeFactory->create();
                $customAttribute->load($id);
                $name = $customAttribute->getName();
                $customAttribute->delete();
                $this->messageManager->addSuccess(__('The Custom Attribute has been deleted.'));
                $this->_eventManager->dispatch(
                    'adminhtml_dealer4dealer_xcore_custom_attribute_on_delete',
                    ['name' => $name, 'status' => 'success']
                );
                $resultRedirect->setPath('dealer4dealer_xcore/*/');
                return $resultRedirect;
            } catch (\Exception $e) {
                $this->_eventManager->dispatch(
                    'adminhtml_dealer4dealer_xcore_custom_attribute_on_delete',
                    ['name' => $name, 'status' => 'fail']
                );
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                $resultRedirect->setPath('dealer4dealer_xcore/*/edit', ['id' => $id]);
                return $resultRedirect;
            }
        }
        // display error message
        $this->messageManager->addError(__('Custom Attribute to delete was not found.'));
        // go to grid
        $resultRedirect->setPath('dealer4dealer_xcore/*/');
        return $resultRedirect;
    }
}