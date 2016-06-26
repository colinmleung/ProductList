<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Daiga\ProductList\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        /**
         * Create table 'productlist'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable('productlist')
        )->addColumn(
            'productlist_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'Productlist ID'
        )->addColumn(
            'customer_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['unsigned' => true, 'nullable' => false, 'default' => '0'],
            'Customer ID'
        )->addColumn(
            'list_type',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['unsigned' => true, 'nullable' => false, 'default' => '0'],
            'List Type'
        )->addForeignKey(
            $installer->getFkName('productlist', 'customer_id', 'customer_entity', 'entity_id'),
            'customer_id',
            $installer->getTable('customer_entity'),
            'entity_id',
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
        )->setComment(
            'Productlist main Table'
        );
        $installer->getConnection()->createTable($table);

        /**
         * Create table 'productlist_item'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable('productlist_item')
        )->addColumn(
            'productlist_item_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'Productlist item ID'
        )->addColumn(
            'productlist_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['unsigned' => true, 'nullable' => false, 'default' => '0'],
            'Productlist ID'
        )->addColumn(
            'product_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['unsigned' => true, 'nullable' => false, 'default' => '0'],
            'Product ID'
        )->addColumn(
            'description',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '64k',
            [],
            'Short description of wish list item'
        )->addColumn(
            'qty',
            \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
            '12,4',
            ['nullable' => false],
            'Qty'
        )->addIndex(
            $installer->getIdxName('productlist_item', 'productlist_id'),
            'productlist_id'
        )->addForeignKey(
            $installer->getFkName('productlist_item', 'productlist_id', 'productlist', 'productlist_id'),
            'productlist_id',
            $installer->getTable('productlist'),
            'productlist_id',
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
        )->addIndex(
            $installer->getIdxName('productlist_item', 'product_id'),
            'product_id'
        )->addForeignKey(
            $installer->getFkName('productlist_item', 'product_id', 'catalog_product_entity', 'entity_id'),
            'product_id',
            $installer->getTable('catalog_product_entity'),
            'entity_id',
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
        )->setComment(
            'Productlist items'
        );
        $installer->getConnection()->createTable($table);

        $installer->endSetup();

    }
}
