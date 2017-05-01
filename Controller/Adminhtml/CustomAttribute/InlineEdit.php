<?php

namespace Dealer4dealer\Xcore\Controller\Adminhtml\CustomAttribute;

class InlineEdit extends \Magento\Backend\App\Action
{
    /**
     * JSON Factory
     *
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $_jsonFactory;

    /**
     * Custom Attribute Factory
     *
     * @var \Dealer4dealer\Xcore\Model\CustomAttributeFactory
     */
    protected $_customAttributeFactory;

    /**
     * Constructor
     *
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     * @param \Dealer4dealer\Xcore\Model\CustomAttributeFactory $customAttributeFactory
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Dealer4dealer\Xcore\Model\CustomAttributeFactory $customAttributeFactory,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->_jsonFactory = $jsonFactory;
        $this->_customAttributeFactory = $customAttributeFactory;
        parent::__construct($context);
    }
    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->_jsonFactory->create();
        $error = false;
        $messages = [];
        $customAttributeItems = $this->getRequest()->getParam('items', []);
        if (!($this->getRequest()->getParam('isAjax') && count($customAttributeItems))) {
            return $resultJson->setData([
                'messages' => [__('Please correct the data sent.')],
                'error' => true,
            ]);
        }
        foreach (array_keys($customAttributeItems) as $customAttributeId) {
            /** @var \Dealer4dealer\Xcore\Model\CustomAttribute $customAttribute */
            $customAttribute = $this->_customAttributeFactory->create()->load($customAttributeId);
            try {
                $customAttributeData = $customAttributeItems[$customAttributeId];
                $customAttribute->addData($customAttributeData);
                $customAttribute->save();
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $messages[] = $this->getErrorWithCustomAttributeId($customAttribute, $e->getMessage());
                $error = true;
            } catch (\RuntimeException $e) {
                $messages[] = $this->getErrorWithCustomAttributeId($customAttribute, $e->getMessage());
                $error = true;
            } catch (\Exception $e) {
                $messages[] = $this->getErrorWithCustomAttributeId(
                    $customAttribute,
                    __('Something went wrong while saving the Custom Attribute.')
                );
                $error = true;
            }
        }
        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    /**
     * Add Custom Attribute ID to error message
     *
     * @param \Dealer4dealer\Xcore\Model\CustomAttribute $customAttribute
     * @param string $errorText
     * @return string
     */
    protected function getErrorWithCustomAttributeId(\Dealer4dealer\Xcore\Model\CustomAttribute $customAttribute, $errorText)
    {
        return '[Custom Attribute ID: ' . $customAttribute->getId() . '] ' . $errorText;
    }
}