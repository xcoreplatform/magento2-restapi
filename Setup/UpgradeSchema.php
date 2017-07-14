<?php

namespace Dealer4dealer\Xcore\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * upgrade tables
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        if (!$installer->tableExists('dealer4dealer_xcore_custom_attribute')) {
            $table = $installer->getConnection()
                               ->newTable($installer->getTable('dealer4dealer_xcore_custom_attribute'))
                               ->addColumn(
                                   'id',
                                   Table::TYPE_INTEGER,
                                   null,
                                   [
                                       'identity' => true,
                                       'nullable' => false,
                                       'primary'  => true,
                                       'unsigned' => true,
                                   ],
                                   'Custom Attribute ID'
                               )
                               ->addColumn(
                                   'from',
                                   Table::TYPE_TEXT,
                                   255,
                                   ['nullable => false'],
                                   'Custom Attribute From'
                               )
                               ->addColumn(
                                   'to',
                                   Table::TYPE_TEXT,
                                   255,
                                   ['nullable => false'],
                                   'Custom Attribute To'
                               )
                               ->addColumn(
                                   'type',
                                   Table::TYPE_TEXT,
                                   255,
                                   [],
                                   'Custom Attribute Type'
                               )
                               ->addColumn(
                                   'created_at',
                                   Table::TYPE_TIMESTAMP,
                                   null,
                                   [],
                                   'Custom Attribute Created At'
                               )
                               ->addColumn(
                                   'updated_at',
                                   Table::TYPE_TIMESTAMP,
                                   null,
                                   [],
                                   'Custom Attribute Updated At'
                               )
                               ->setComment('Custom Attribute Table');
            $installer->getConnection()->createTable($table);

        }

        if (version_compare($context->getVersion(), '0.7.0', '<')) {
            $tableName = 'sales_shipment';
            if ($setup->getConnection()->isTableExists($tableName) == true) {
                $connection = $setup->getConnection();
                $connection->addColumn(
                    $tableName,
                    'xcore_your_ref',
                    ['type' => Table::TYPE_TEXT, 'length' => 50, 'nullable' => true, 'default' => null, 'comment' => 'xCore Your Reference']
                );
            }
        }

        if (version_compare($context->getVersion(), '0.8.0', '<')) {
            $priceListTableName = 'dealer4dealer_xcore_price_list';

            $table = $installer->getConnection()
                               ->newTable($installer->getTable($priceListTableName))
                               ->addColumn(
                                   'id',
                                   Table::TYPE_INTEGER,
                                   null,
                                   [
                                       'identity' => true,
                                       'unsigned' => true,
                                       'nullable' => false,
                                       'primary'  => true
                                   ],
                                   'ID'
                               )
                               ->addColumn(
                                   'price_list_id',
                                   Table::TYPE_TEXT,
                                   50,
                                   [
                                       'unsigned' => true,
                                       'nullable' => false
                                   ],
                                   'Price List ID'
                               )
                               ->addColumn(
                                   'start_date',
                                   Table::TYPE_DATETIME,
                                   null,
                                   [
                                       'nullable' => true,
                                       'default'  => null
                                   ],
                                   'Start Date'
                               )
                               ->addColumn(
                                   'end_date',
                                   Table::TYPE_DATETIME,
                                   null,
                                   [
                                       'nullable' => true,
                                       'default'  => null
                                   ],
                                   'End Date'
                               )
                               ->addIndex(
                                   'IDX_D4D_PL_PRICE_LIST_ID',
                                   ['price_list_id']
                               )
                               ->setComment('xCore Price List Table');
            $installer->getConnection()->createTable($table);

            $customerGroupWebsiteTableName = 'dealer4dealer_xcore_price_list_customer_group_website';

            $table = $installer->getConnection()
                               ->newTable($installer->getTable($customerGroupWebsiteTableName))
                               ->addColumn(
                                   'id',
                                   Table::TYPE_INTEGER,
                                   null,
                                   [
                                       'identity' => true,
                                       'unsigned' => true,
                                       'nullable' => false,
                                       'primary'  => true
                                   ],
                                   'ID'
                               )
                               ->addColumn(
                                   'price_list_id',
                                   Table::TYPE_TEXT,
                                   50,
                                   [
                                       'unsigned' => true,
                                       'nullable' => false
                                   ],
                                   'Price List ID'
                               )
                               ->addColumn(
                                   'all_groups',
                                   Table::TYPE_SMALLINT,
                                   5,
                                   [
                                       'unsigned' => true,
                                       'nullable' => false,
                                       'default'  => 1
                                   ],
                                   'Is Applicable To All Customer Groups'
                               )
                               ->addColumn(
                                   'customer_group_id',
                                   Table::TYPE_SMALLINT,
                                   5,
                                   [
                                       'unsigned' => true,
                                       'nullable' => false,
                                       'default'  => 0
                                   ],
                                   'Customer Group ID'
                               )
                               ->addColumn(
                                   'website_id',
                                   Table::TYPE_SMALLINT,
                                   5,
                                   [
                                       'unsigned' => true,
                                       'nullable' => false
                                   ],
                                   'Website ID'
                               )
                               ->addForeignKey(
                                   'FK_D4D_PLCGW_PRICE_LIST_ID',
                                   'price_list_id',
                                   $installer->getTable($priceListTableName),
                                   'price_list_id',
                                   Table::ACTION_CASCADE
                               )
                               ->addForeignKey(
                                   'FK_D4D_PLCGW_CUSTOMER_GROUP_ID',
                                   'customer_group_id',
                                   $installer->getTable('customer_group'),
                                   'customer_group_id',
                                   Table::ACTION_CASCADE
                               )
                               ->addForeignKey(
                                   'FK_D4D_PLCGW_WEBSITE_ID',
                                   'website_id',
                                   $installer->getTable('store_website'),
                                   'website_id',
                                   Table::ACTION_CASCADE
                               )
                               ->setComment('xCore Price List: Customer Group and Website Table');
            $installer->getConnection()->createTable($table);

            $tierPriceTableName = 'dealer4dealer_xcore_price_list_product_entity_tier_price';

            $table = $installer->getConnection()
                               ->newTable($installer->getTable($tierPriceTableName))
                               ->addColumn(
                                   'id',
                                   Table::TYPE_INTEGER,
                                   null,
                                   [
                                       'identity' => true,
                                       'unsigned' => true,
                                       'nullable' => false,
                                       'primary'  => true
                                   ],
                                   'ID'
                               )
                               ->addColumn(
                                   'price_list_id',
                                   Table::TYPE_TEXT,
                                   50,
                                   [
                                       'unsigned' => true,
                                       'nullable' => false
                                   ],
                                   'Price List ID'
                               )
                               ->addColumn(
                                   'product_id',
                                   Table::TYPE_INTEGER,
                                   null,
                                   [
                                       'unsigned' => true,
                                       'nullable' => false
                                   ],
                                   'Product ID'
                               )
                               ->addColumn(
                                   'qty',
                                   Table::TYPE_DECIMAL,
                                   null,
                                   [
                                       'nullable'  => false,
                                       'scale'     => 4,
                                       'precision' => 12,
                                       'default'   => 1.0000
                                   ],
                                   'QTY'
                               )
                               ->addColumn(
                                   'value',
                                   Table::TYPE_DECIMAL,
                                   null,
                                   [
                                       'nullable'  => false,
                                       'scale'     => 4,
                                       'precision' => 12,
                                       'default'   => 0.0000
                                   ],
                                   'Value'
                               )
                               ->addIndex(
                                   'IDX_D4D_PLPETP_PRICE_LIST_ID_PRODUCT_ID_QTY',
                                   ['price_list_id', 'product_id', 'qty'],
                                   ['type' => 'UNIQUE']
                               )
                               ->addForeignKey(
                                   'FK_D4D_PLPETP_PRICE_LIST_ID',
                                   'price_list_id',
                                   $installer->getTable($priceListTableName),
                                   'price_list_id',
                                   Table::ACTION_CASCADE
                               )
                               ->addForeignKey(
                                   'FK_D4D_PLPETP_PRODUCT_ID',
                                   'product_id',
                                   $installer->getTable('catalog_product_entity'),
                                   'entity_id',
                                   Table::ACTION_CASCADE
                               )
                               ->setComment('xCore Price List: Product Entity Tier Price Table');
            $installer->getConnection()->createTable($table);
        }

        $installer->endSetup();
    }
}
