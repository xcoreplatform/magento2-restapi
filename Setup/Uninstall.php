<?php

namespace Dealer4dealer\Xcore\Setup;

use Magento\Customer\Model\Customer;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UninstallInterface;
use Magento\Tax\Model\ClassModel;
use Magento\Tax\Model\TaxClass\Repository as TaxClassRepository;

class Uninstall implements UninstallInterface
{
    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var TaxClassRepository
     */
    protected $taxClassRepository;

    /**
     * @var EavSetupFactory
     */
    protected $eavSetupFactory;

    /**
     * Constructor
     *
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param TaxClassRepository    $taxRepository
     * @param EavSetupFactory       $eavSetupFactory
     */
    public function __construct(
        SearchCriteriaBuilder $searchCriteriaBuilder,
        TaxClassRepository $taxRepository,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->taxClassRepository    = $taxRepository;
        $this->eavSetupFactory       = $eavSetupFactory;
    }

    /**
     * @param SchemaSetupInterface   $setup
     * @param ModuleContextInterface $context
     *
     * @return void
     * @throws CouldNotDeleteException
     * @throws InputException
     * @throws NoSuchEntityException
     */
    public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create();

        $setup->startSetup();

        $this->removeRefFromSalesShipment($setup);

        $this->dropTable($setup, 'dealer4dealer_price_list_item');
        $this->dropTable($setup, 'dealer4dealer_price_list');

        $this->dropCustomerAttribute($eavSetup, 'vat_class');
        $this->dropCustomerAttribute($eavSetup, 'price_list');

        $this->removeTaxClasses();
    }

    /**
     * @param SchemaSetupInterface $setup
     * @param string               $table
     *
     * @return void
     */
    protected function dropTable(SchemaSetupInterface $setup, string $table): void
    {
        $tableName = $setup->getConnection()->getTableName($table);

        if ($setup->getConnection()->isTableExists($tableName)) {
            $setup->getConnection()->dropTable($setup->getTable($table));
        }
    }

    /**
     * @param SchemaSetupInterface $setup
     *
     * @return void
     */
    protected function removeRefFromSalesShipment(SchemaSetupInterface $setup): void
    {
        $tableName = $setup->getConnection()->getTableName('sales_shipment');

        if ($setup->getConnection()->isTableExists($tableName)) {
            $setup->getConnection()->dropColumn($tableName, 'xcore_your_ref');
        }
    }

    /**
     * @param EavSetup $eavSetup
     * @param string   $attribute
     *
     * @return void
     */
    protected function dropCustomerAttribute(EavSetup $eavSetup, string $attribute): void
    {
        $eavSetup->removeAttribute(Customer::ENTITY, $attribute);
    }

    /**
     * @return void
     * @throws CouldNotDeleteException
     * @throws InputException
     * @throws NoSuchEntityException
     */
    protected function removeTaxClasses(): void
    {
        $data = [
            [
                'class_name' => 'xCore Excluding VAT',
                'class_type' => ClassModel::TAX_CLASS_TYPE_CUSTOMER,
            ],
            [
                'class_name' => 'xCore Including VAT',
                'class_type' => ClassModel::TAX_CLASS_TYPE_CUSTOMER,
            ],
        ];

        foreach ($data as $row) {
            // Find the tax class
            $searchCriteria = $this->searchCriteriaBuilder
                ->setFilterGroups([])
                ->addFilter('class_name', $row['class_name'])
                ->create();

            $taxClassCollection = $this->taxClassRepository->getList($searchCriteria);

            // If the tax class doesn't exists, skip to next loop.
            if (!$taxClassCollection->getItems()) {
                continue;
            }

            foreach ($taxClassCollection->getItems() as $taxClass) {
                $this->taxClassRepository->delete($taxClass);
            }
        }
    }
}
