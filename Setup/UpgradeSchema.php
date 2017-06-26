<?php
namespace Dealer4dealer\Xcore\Setup;

class UpgradeSchema implements \Magento\Framework\Setup\UpgradeSchemaInterface
{
    /**
     * upgrade tables
     *
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface $context
     * @return void
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function upgrade(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        if (!$installer->tableExists('dealer4dealer_xcore_custom_attribute')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('dealer4dealer_xcore_custom_attribute')
            )
                ->addColumn(
                    'id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
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
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'Custom Attribute From'
                )
                ->addColumn(
                    'to',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'Custom Attribute To'
                )
                ->addColumn(
                    'type',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [],
                    'Custom Attribute Type'
                )
                ->addColumn(
                    'created_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    [],
                    'Custom Attribute Created At'
                )
                ->addColumn(
                    'updated_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
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
                    ['type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 'length' => 50, 'nullable' => true, 'default' => null, 'comment' => 'xCore Your Reference']
                );
            }
        }

        $installer->endSetup();
    }
}
