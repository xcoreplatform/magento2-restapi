<?php

namespace Dealer4dealer\Xcore\Plugin\Magento\Sales\Api\Data;

class InvoiceInterface
{
    protected $objectManager;

    private $extensionFactory;

    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Sales\Api\Data\InvoiceExtensionFactory $extensionFactory
    )
    {
        $this->objectManager = $objectManager;
        $this->extensionFactory = $extensionFactory;
    }

    /**
     * @param \Magento\Sales\Api\Data\InvoiceInterface $subject
     * @param $result
     * @return \Magento\Sales\Api\Data\InvoiceExtensionInterface|null
     */
    public function afterGetExtensionAttributes(
        \Magento\Sales\Api\Data\InvoiceInterface $subject,
        $result
    ) {

        if ($result === null) {
            $result = $this->extensionFactory->create();
        }

        // Get the custom attributes
        $repo = $this->objectManager->get('Dealer4dealer\Xcore\Model\CustomAttributeRepository');
        $customInvoiceAttributes = $repo->getListByType('invoice');

        // Get the actual value of the custom attributes
        $customAttributes = [];
        foreach($customInvoiceAttributes as $customInvoiceAttribute) {
            $key = $customInvoiceAttribute['to'];
            $value = $subject->getData($customInvoiceAttribute['from']);
            $customAttributes[] = ['key' => $key, 'value' => $value];
        }

        // Set the Extension Attributes for Xcore Custom Attributes
        $result->setXcoreCustomAttributes($customAttributes);

        return $result;
    }
}