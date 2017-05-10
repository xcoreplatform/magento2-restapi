<?php

namespace Dealer4dealer\Xcore\Controller\Adminhtml\CustomAttribute;

use Magento\Framework\Exception\LocalizedException;

abstract class Save extends \Dealer4dealer\Xcore\Controller\Adminhtml\CustomAttribute
{

    protected $dataPersistor;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('id');

            $model = $this->_objectManager->create('Dealer4dealer\Xcore\Model\CustomAttribute')->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addError(__('This Customattribute no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            $data['type'] = $this->getType();
            $data['created_at'] = date("Y-m-d H:i:s");
            $data['updated_at'] = date("Y-m-d H:i:s");

            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccess(__('You saved the Customattribute.'));
                $this->dataPersistor->clear('dealer4dealer_xcore_customattribute');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the Customattribute.'));
            }

            $this->dataPersistor->set('dealer4dealer_xcore_customattribute', $data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }

    public abstract function getType();
}