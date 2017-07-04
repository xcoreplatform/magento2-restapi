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
            $tableName = 'dealer4dealer_xcore_price_list';
            $table     = $installer->getConnection()
                                   ->newTable($installer->getTable($tableName))
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
                                       $installer->getIdxName('xcore_price_list', ['price_list_id']),
                                       ['price_list_id']
                                   )
                                   ->setComment('xCore Price List Table');
            $installer->getConnection()->createTable($table);

            $tableName = 'dealer4dealer_xcore_price_list_customer_group';
            $table     = $installer->getConnection()
                                   ->newTable($installer->getTable($tableName))
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
                                       'customer_group_id',
                                       Table::TYPE_SMALLINT,
                                       5,
                                       [
                                           'unsigned' => true,
                                           'nullable' => true
                                       ],
                                       'Customer Group ID'
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
                                   ->addForeignKey(
                                       $installer->getFkName(
                                           'dealer4dealer_xcore_price_list_customer_group',
                                           'customer_group_id',
                                           'customer_group',
                                           'customer_group_id'
                                       ),
                                       'customer_group_id',
                                       $installer->getTable('customer_group'),
                                       'customer_group_id',
                                       Table::ACTION_CASCADE
                                   )
                                   ->addForeignKey(
                                       $installer->getFkName(
                                           'dealer4dealer_xcore_price_list_customer_group',
                                           'price_list_id',
                                           'dealer4dealer_xcore_price_list',
                                           'price_list_id'
                                       ),
                                       'price_list_id',
                                       $installer->getTable('dealer4dealer_xcore_price_list'),
                                       'price_list_id',
                                       Table::ACTION_CASCADE
                                   )
                                   ->setComment('xCore Price List Customer Group Table');
            $installer->getConnection()->createTable($table);
        }

        $installer->endSetup();
    }
}
