<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright  Copyright (c)  2023.  Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\FaqGraphQL\Setup;

use Magento\Framework\Db\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Zend_Db_Exception;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * @throws Zend_Db_Exception
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ): void {
        $installer = $setup;
        $installer->startSetup();
        $table = $installer->getConnection()
            ->newTable($installer->getTable('Tigren_faq_graphql'))
            ->addColumn(
                'faq_id',
                Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true,
                    'nullable' => false,
                    'primary' =>
                        true,
                    'unsigned' => true
                ],
                'Faq Id'
            )->addColumn(
                'question',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Faq question'
            )->addColumn(
                'author',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Faq author'
            )->addColumn(
                'answer',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Faq answer'
            )->addColumn(
                'status',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Faq status'
            )->addColumn(
                'product',
                Table::TYPE_INTEGER,
                null,
                ['nullable' => false],
                'Faq product'
            )->addColumn(
                'position',
                Table::TYPE_INTEGER,
                null,
                ['nullable' => false],
                'Faq position'
            )->setComment(
                'Tigren Faq GraphQL Table'
            );
        $installer->getConnection()->createTable($table);
        $installer->endSetup();
    }
}
