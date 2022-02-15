<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 28.05.2019
 * Time: 22:22
 * Project: steellinevds
 */

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190729124248 extends AbstractMigration
{

    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('parameter_price')) {
            $schema->dropTable('parameter_price');
        }

        if (!$schema->hasTable('parameter_price')) {
            $table = $schema->createTable('parameter_price');

            $table->addColumn('parameter_price_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('product_type_parameter_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('value_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('price', 'decimal', ['notnull' => true]);
            $table->addColumn('conditions', 'json', ['notnull' => true]);

            $table->addColumn('coefficient_to_base', 'float', ['notnull' => false]);
            $table->addColumn('coefficient_additional_square', 'float', ['notnull' => false]);
            $table->addColumn('max_square', 'float', ['notnull' => false]);
            $table->addColumn('date', 'datetime', ['notnull' => true]);

            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);

            $table->setPrimaryKey(['parameter_price_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения цен для параметров');

            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['product_type_parameter_id'], 'product_type_parameter_id');
            $table->addIndex(['value_id'], 'parameter_price_value');

            $table->addForeignKeyConstraint('product_type_parameter', ['product_type_parameter_id'], ['product_type_parameter_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_PARAMETER_TYPE_PRODUCT_PARAMETER_PRICE');
            $table->addForeignKeyConstraint('parameter_value', ['value_id'], ['value_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_PARAMETER_VALUE_PARAMETER_PRICE');

        }
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('parameter_price'))
        {
            $schema->dropTable('parameter_price');
        }
    }
}
