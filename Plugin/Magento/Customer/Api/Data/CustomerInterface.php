<?php

namespace Dealer4dealer\Xcore\Plugin\Magento\Customer\Api\Data;

class CustomerInterface
{
    protected $objectManager;

    private $extensionFactory;

    /**
     * CustomerInterface constructor.
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param \Magento\Customer\Api\Data\CustomerExtensionFactory $extensionFactory
     */
    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Customer\Api\Data\CustomerExtensionFactory $extensionFactory
    )
    {
        $this->objectManager = $objectManager;
        $this->extensionFactory = $extensionFactory;
    }

//    /**
//     * @api
//     * @param \Magento\Customer\Api\Data\CustomerInterface $subject
//     * @param $result
//     * @return \Magento\Customer\Api\Data\CustomerExtensionInterface
//     */
//    public function afterGetExtensionAttributes(
//        \Magento\Customer\Api\Data\CustomerInterface $subject,
//        $result
//    ) {
//
//        if ($result === null) {
//            $result = $this->extensionFactory->create();
//        }
//
//        // Get the custom attributes
//        $repo = $this->objectManager->get('Dealer4dealer\Xcore\Model\CustomAttributeRepository');
//        $customCustomerAttributes = $repo->getListByType('customer');
//
//        // Get the actual value of the custom attributes
//        $customAttributes = [];
//        foreach($customCustomerAttributes as $customCustomerAttribute) {
//            $key = $customCustomerAttribute['to'];
//            $value = $subject->getCustomAttribute($customCustomerAttribute['from']);
//            if(!$value)
//                $value = $subject->{"get".$customCustomerAttribute['from']}();
//            $customAttributes[] = ['key' => $key, 'value' => $value];
//        }
//
//        // Set the Extension Attributes for Xcore Custom Attributes
//        $result->setXcoreCustomAttributes($customAttributes);
//
//        return $result;
//    }
}