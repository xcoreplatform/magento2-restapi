<?php

namespace Dealer4dealer\Xcore\Setup;

use Magento\Customer\Setup\CustomerSetup;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Tax\Model\ClassModel;
use Magento\Tax\Model\TaxClass\Repository as TaxClassRepository;

class UpgradeData implements UpgradeDataInterface
{
    private $customerSetupFactory;
    private $searchCriteriaBuilder;
    private $taxClassRepository;
    const NOTE = 'This setting is part of the Price List add-on in the xCore.
                  Interested? Install the add-on for your xCore app. 
                  For more information, contact us at www.dealer4dealer.nl!';

    /**
     * {@inheritdoc}
     */
    public function upgrade(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '0.9.0', '<')) {
            /** @var CustomerSetup $customerSetup */
            $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);

            $customerSetup->addAttribute('customer', 'price_list', [
                'type'     => 'int',
                'label'    => 'Price List',
                'input'    => 'select',
                'source'   => 'Dealer4dealer\Xcore\Model\PriceList\Attribute\Source\PriceList',
                'required' => false,
                'visible'  => true,
                'position' => 500,
                'system'   => false,
                'backend'  => '',
                'note'     => self::NOTE
            ]);

            $attribute = $customerSetup->getEavConfig()->getAttribute('customer', 'price_list')
                                       ->addData([
                                                     'used_in_forms' => [
                                                         'adminhtml_customer'
                                                     ]
                                                 ]);
            $attribute->save();

            $customerSetup->addAttribute('customer', 'vat_class', [
                'type'     => 'varchar',
                'label'    => 'VAT Class',
                'input'    => 'select',
                'source'   => 'Dealer4dealer\Xcore\Model\Customer\Attribute\Source\VatClass',
                'required' => false,
                'visible'  => true,
                'position' => 501,
                'system'   => false,
                'backend'  => '',
                'note'     => self::NOTE
            ]);

            $attribute = $customerSetup->getEavConfig()->getAttribute('customer', 'vat_class')
                                       ->addData([
                                                     'used_in_forms' => [
                                                         'adminhtml_customer'
                                                     ]
                                                 ]);
            $attribute->save();

            /**
             * Install tax classes
             */
            $data = [
                [
                    'class_name' => 'xCore Excluding VAT',
                    'class_type' => ClassModel::TAX_CLASS_TYPE_CUSTOMER
                ],
                [
                    'class_name' => 'xCore Including VAT',
                    'class_type' => ClassModel::TAX_CLASS_TYPE_CUSTOMER
                ],
            ];
            foreach ($data as $row) {
                // Find the tax class
                $searchCriteria     = $this->searchCriteriaBuilder->setFilterGroups([])
                                                                  ->addFilter('class_name', $row['class_name'])
                                                                  ->create();
                $taxClassCollection = $this->taxClassRepository->getList($searchCriteria);

                // If the tax class already exists, do not add it again.
                if ($taxClassCollection->getItems()) {
                    continue;
                }

                $setup->getConnection()->insert($setup->getTable('tax_class'), $row);
            }
        }

        if (version_compare($context->getVersion(), '2.6.0', '<')) {
            /**
             * Update tax classes
             */
            $data = [
                [
                    'old_class_name' => 'xCore Excluding VAT',
                    'new_class_name' => 'xCore Without VAT',
                ],
                [
                    'old_class_name' => 'xCore Including VAT',
                    'new_class_name' => 'xCore With VAT',
                ],
            ];
            foreach ($data as $row) {
                // Find the tax class
                $searchCriteria     = $this->searchCriteriaBuilder->create();
                $taxClassCollection = $this->taxClassRepository->getList($searchCriteria);

                foreach ($taxClassCollection->getItems() as $taxClass) {
                    if (!str_contains($taxClass->getClassName(), $row['old_class_name'])) {
                        continue;
                    }
                    $taxClass->setClassName($row['new_class_name']);
                    $this->taxClassRepository->save($taxClass);
                }
            }
        }

        $setup->endSetup();
    }

    /**
     * Constructor
     *
     * @param CustomerSetupFactory  $customerSetupFactory
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param TaxClassRepository    $taxRepository
     */
    public function __construct(
        CustomerSetupFactory $customerSetupFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        TaxClassRepository $taxRepository
    ) {
        $this->customerSetupFactory  = $customerSetupFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->taxClassRepository    = $taxRepository;
    }
}