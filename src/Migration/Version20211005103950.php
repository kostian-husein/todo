<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 05.10.2021
 * Time: 13:48
 * Project: steelline
 */

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Add completion_date column to order_item table
 */
final class Version20211005103950 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription() : string
    {
        return 'Add completion_date column to order_item table';
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('order_item')) {
            $table = $schema->getTable('order_item');

            if (!$table->hasColumn('completion_date')) {
                $table->addColumn('completion_date', 'datetime', ['notnull' => false, 'default' => null]);
            }
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('order_item')) {
            $table = $schema->getTable('order_item');

            if ($table->hasColumn('completion_date')) {
                $table->dropColumn('completion_date');
            }
        }
    }
}
