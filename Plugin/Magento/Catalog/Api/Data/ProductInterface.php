<?php

namespace Dealer4dealer\Xcore\Plugin\Magento\Catalog\Api\Data;

class ProductInterface
{

    protected $objectManager;

    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager
    )
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @param \Magento\Catalog\Api\Data\ProductInterface $subject
     * @param $result
     * @return \Magento\Catalog\Api\Data\ProductExtensionInterface|null
     */
    public function afterGetExtensionAttributes(
        \Magento\Catalog\Api\Data\ProductInterface $subject,
        $result
    ) {

        // Get the custom attributes
        $repo = $this->objectManager->get('Dealer4dealer\Xcore\Model\CustomAttributeRepository');
        $customProductAttributes = $repo->getListByType('product');

        // Get the actual value of the custom attributes
        $customAttributes = [];
        foreach($customProductAttributes as $customProductAttribute) {
            $key = $customProductAttribute['to'];
            $value = $subject->getData($customProductAttribute['from']);

            if($value) {
                $attr = $subject->getResource()->getAttribute($customProductAttribute['from']);
                if ($attr && $attr->usesSource()) {
                    $value = $attr->getSource()->getOptionText($value);
                }
            }

            $customAttributes[] = ['key' => $key, 'value' => $value];
        }

        // Set the Extension Attributes for Xcore Custom Attributes
        $result->setXcoreCustomAttributes($customAttributes);

        return $result;
    }
}