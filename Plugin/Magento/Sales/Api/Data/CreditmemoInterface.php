<?php

namespace Dealer4dealer\Xcore\Plugin\Magento\Sales\Api\Data;

class CreditmemoInterface
{
    protected $objectManager;

    private $extensionFactory;

    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Sales\Api\Data\CreditmemoExtensionFactory $extensionFactory
    )
    {
        $this->objectManager = $objectManager;
        $this->extensionFactory = $extensionFactory;
    }

    /**
     * @param \Magento\Sales\Api\Data\CreditmemoInterface $subject
     * @param $result
     * @return \Magento\Sales\Api\Data\CreditmemoExtensionInterface|null
     */
    public function afterGetExtensionAttributes(
        \Magento\Sales\Api\Data\CreditmemoInterface $subject,
        $result
    ) {

        if ($result === null) {
            $result = $this->extensionFactory->create();
        }

        // Get the custom attributes
        $repo = $this->objectManager->get('Dealer4dealer\Xcore\Model\CustomAttributeRepository');
        $customCreditAttributes = $repo->getListByType('credit');

        // Get the actual value of the custom attributes
        $customAttributes = [];
        foreach($customCreditAttributes as $customCreditAttribute) {
            if(isset($customCreditAttribute['to'])) {
                $key = $customCreditAttribute['to'];
                $value = $subject->getData($customCreditAttribute['from']);
                $customAttributes[] = ['key' => $key, 'value' => $value];
            }

        }

        // Set the Extension Attributes for Xcore Custom Attributes
        $result->setXcoreCustomAttributes($customAttributes);

        return $result;
    }
}