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
                    [
                        'type'     => Table::TYPE_TEXT,
                        'length'   => 50,
                        'nullable' => true,
                        'default'  => null,
                        'comment'  => 'xCore Your Reference'
                    ]
                );
            }
        }

        if (version_compare($context->getVersion(), '0.9.0', '<')) {
            $table_dealer4dealer_price_list = $setup->getConnection()->newTable(
                $setup->getTable('dealer4dealer_price_list')
            );

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

            $table_dealer4dealer_price_list_item = $setup->getConnection()->newTable(
                $setup->getTable('dealer4dealer_price_list_item')
            );

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

        /**
         * Remake indexes
         */
        if (version_compare($context->getVersion(), '2.1.1', '<')) {
            $priceListItemTableName = $setup->getTable('dealer4dealer_price_list_item');
            $priceListTableName     = $setup->getTable('dealer4dealer_price_list');
            $productTableName       = $setup->getTable('catalog_product_entity');

            $setup->getConnection()->dropForeignKey($priceListItemTableName, 'FK_PRICE_LIST_ID');
            $setup->getConnection()->dropForeignKey($priceListItemTableName, 'FK_PRODUCT_SKU');

            $setup->getConnection()->addForeignKey(
                'FK_PRICE_LIST_ID',
                $priceListItemTableName,
                'price_list_id',
                $priceListTableName,
                'id',
                Table::ACTION_CASCADE
            );

            $setup->getConnection()->addForeignKey(
                'FK_PRODUCT_SKU',
                $priceListItemTableName,
                'product_sku',
                $productTableName,
                'sku',
                Table::ACTION_CASCADE
            );
        }

        /**
         * Remove fk from sku due to error on sku changes
         */
        if (version_compare($context->getVersion(), '2.1.3', '<')) {
            $priceListItemTableName = $setup->getTable('dealer4dealer_price_list_item');
            $setup->getConnection()->dropForeignKey($priceListItemTableName, 'FK_PRODUCT_SKU');
        }

        /**
         * Add some columns to price list item table
         */
        if (version_compare($context->getVersion(), '2.5.0', '<')) {
            $priceListItemTableName = $setup->getTable('dealer4dealer_price_list_item');
            $setup->getConnection()->addColumn(
                $priceListItemTableName,
                'created_at',
                [
                    'type'     => Table::TYPE_TIMESTAMP,
                    'default'  => Table::TIMESTAMP_INIT,
                    'nullable' => false,
                    'comment'  => 'Price List Item created'
                ]
            );

            $setup->getConnection()->addColumn(
                $priceListItemTableName,
                'updated_at',
                [
                    'type'     => Table::TYPE_TIMESTAMP,
                    'default'  => Table::TIMESTAMP_INIT_UPDATE,
                    'nullable' => false,
                    'comment'  => 'Price List Item updated'
                ]
            );

            $setup->getConnection()->addColumn(
                $priceListItemTableName,
                'error_count',
                [
                    'type'     => Table::TYPE_INTEGER,
                    'nullable' => false,
                    'comment'  => 'Price List Item error count',
                    'default'  => 0
                ]
            );
        }

        if(version_compare($context->getVersion(), '2.7.0', '<')){
            $table_dealer4dealer_price_list_item_group = $setup->getConnection()->newTable(
                $setup->getTable('dealer4dealer_price_list_item_group')
            );

            $table_dealer4dealer_price_list_item_group
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
                    'Price List Item Group ID'
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
                    'item_group',
                    Table::TYPE_INTEGER,
                    10,
                    [
                        'nullable' => false,
                    ]
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
                    'Price List Item Group Quantity'
                )
                ->addColumn(
                    'discount',
                    Table::TYPE_DECIMAL,
                    null,
                    [
                        'nullable' => false,
                        'scale'     => 4,
                    ]
                )
                ->addColumn(
                    'start_date',
                    Table::TYPE_DATE,
                    null,
                    [],
                    'Price List Item Group Start Date'
                )
                ->addColumn(
                    'end_date',
                    Table::TYPE_DATE,
                    null,
                    [],
                    'Price List Item Group End Date'
                )
                ->addColumn(
                    'processed',
                    Table::TYPE_BOOLEAN,
                    null,
                    [
                        'default' => 0
                    ],
                    'Price List Item Group End Date'
                )
                ->addColumn(
                    'created_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    [
                        'default'  => Table::TIMESTAMP_INIT,
                        'nullable' => false,
                    ]
                )
                ->addColumn(
                    'updated_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    [
                        'default'  => Table::TIMESTAMP_INIT_UPDATE,
                        'nullable' => false,
                    ]
                )->addColumn(
                    'error_count',
                    Table::TYPE_INTEGER,
                    [
                        'nullable' => false,
                        'default'  => 0
                    ]
                )
                ->addForeignKey(
                    'FK_ITEM_GROUP_PRICE_LIST_ID',
                    'price_list_id',
                    'dealer4dealer_price_list',
                    'id',
                    Table::ACTION_CASCADE
                );

            $setup->getConnection()->createTable($table_dealer4dealer_price_list_item_group);
        }

        if(version_compare($context->getVersion(), '2.8.0', '<')){
            $priceListTableName = $setup->getTable('dealer4dealer_price_list');
            $setup->getConnection()->addColumn(
                $priceListTableName,
                'customer_group_ids',
                [
                    'type' => Table::TYPE_TEXT,
                    'length' => null,
                    'nullable' => true,
                    'comment' => 'Customer Group ID(s)'
                ]
            );
        }

        $installer->endSetup();
    }
}
