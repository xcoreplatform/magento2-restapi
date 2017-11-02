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
     * @param SchemaSetupInterface   $setup
     * @param ModuleContextInterface $context
     * @return void
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        if (version_compare($context->getVersion(), '0.7.0', '<')) {
            $tableName = $installer->getConnection()->getTableName('sales_shipment');
            if ($setup->getConnection()->isTableExists($tableName) == true) {
                $connection = $setup->getConnection();
                $connection->addColumn(
                    $tableName,
                    'xcore_your_ref',
                    ['type' => Table::TYPE_TEXT, 'length' => 50, 'nullable' => true, 'default' => null, 'comment' => 'xCore Your Reference']
                );
            }
        }

        if (version_compare($context->getVersion(), '0.9.0', '<')) {
            $table_dealer4dealer_price_list = $setup->getConnection()->newTable($setup->getTable('dealer4dealer_price_list'));

            $table_dealer4dealer_price_list
                ->addColumn(
                    'id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'nullable'       => false,
                        'identity'       => true,
                        'auto_increment' => true,
                        'primary'        => true,
                        'unsigned'       => true
                    ],
                    'Price List ID'
                )
                ->addColumn(
                    'guid',
                    Table::TYPE_TEXT,
                    36,
                    [
                        'nullable' => false
                    ],
                    'Price List GUID'
                )
                ->addColumn(
                    'code',
                    Table::TYPE_TEXT,
                    null,
                    [
                        'nullable' => false
                    ],
                    'Price List Code'
                )
                ->addIndex(
                    'IDX_D4D_PRICE_LIST_GUID',
                    [
                        'guid'
                    ],
                    [
                        'type' => 'UNIQUE'
                    ]
                )
                ->setComment('xCore Price List Table');

            $setup->getConnection()->createTable($table_dealer4dealer_price_list);

            $table_dealer4dealer_price_list_item = $setup->getConnection()->newTable($setup->getTable('dealer4dealer_price_list_item'));

            $table_dealer4dealer_price_list_item
                ->addColumn(
                    'id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'nullable'       => false,
                        'identity'       => true,
                        'auto_increment' => true,
                        'primary'        => true,
                        'unsigned'       => true
                    ],
                    'Price List Item ID'
                )
                ->addColumn(
                    'price_list_id',
                    Table::TYPE_INTEGER,
                    10,
                    [
                        'nullable' => false,
                        'unsigned' => true
                    ],
                    'Price List ID'
                )
                ->addColumn(
                    'product_sku',
                    Table::TYPE_TEXT,
                    64,
                    [],
                    'Price List Item Product SKU'
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
                    'Price List Item Quantity'
                )
                ->addColumn(
                    'price',
                    Table::TYPE_DECIMAL,
                    null,
                    [
                        'nullable'  => false,
                        'scale'     => 4,
                        'precision' => 12,
                        'default'   => 0.0000
                    ],
                    'Price List Item Price'
                )
                ->addColumn(
                    'start_date',
                    Table::TYPE_DATE,
                    null,
                    [],
                    'Price List Item Start Date'
                )
                ->addColumn(
                    'end_date',
                    Table::TYPE_DATE,
                    null,
                    [],
                    'Price List Item End Date'
                )
                ->addColumn(
                    'processed',
                    Table::TYPE_BOOLEAN,
                    null,
                    [
                        'default' => 0
                    ],
                    'Price List Item End Date'
                )
                ->addIndex(
                    'IDX_PRICE_LIST_ID_PRODUCT_SKU_QTY',
                    [
                        'price_list_id',
                        'product_sku',
                        'qty'
                    ],
                    [
                        'type' => 'UNIQUE'
                    ]
                )
                ->addForeignKey(
                    'FK_PRICE_LIST_ID',
                    'price_list_id',
                    'dealer4dealer_price_list',
                    'id',
                    Table::ACTION_CASCADE
                )
                ->addForeignKey(
                    'FK_PRODUCT_SKU',
                    'product_sku',
                    'catalog_product_entity',
                    'sku',
                    Table::ACTION_CASCADE
                )
                ->setComment('xCore Price List Item Table');

            $setup->getConnection()->createTable($table_dealer4dealer_price_list_item);
        }

        /**
         * Remove the old custom attribute table.
         */
        if (version_compare($context->getVersion(), '2.0.2', '<')) {
            $tableName = 'dealer4dealer_xcore_custom_attribute';

            if ($setup->getConnection()->isTableExists($tableName) == true) {
                $setup->getConnection()->dropTable($tableName);
            }
        }

        $installer->endSetup();
    }
}
