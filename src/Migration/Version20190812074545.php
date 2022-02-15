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
final class Version20190812074545 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('product_type_parameter')){
            $table = $schema->getTable('product_type_parameter');

            if (!$table->hasColumn('is_initial')){
                $table->addColumn('is_initial', 'boolean', ['unsigned' => true, 'notnull' => true]);
            }

            if (!$table->hasColumn('is_basic')){
                $table->addColumn('is_basic', 'boolean', ['unsigned' => true, 'notnull' => true]);
            }
        }

        if (!$schema->hasTable('price_for_dimension')){
            $table = $schema->createTable('price_for_dimension');

            $table->addColumn('dimension_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('width', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('height', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('value_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('price', 'decimal', ['notnull' => true]);

            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);

            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['value_id'], 'price_for_dimension_value');

            $table->setPrimaryKey(['dimension_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения цен на размеры дверей');

            $table->addForeignKeyConstraint('parameter_value', ['value_id'], ['value_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_PRICE_FOR_DIMENSION_PARAMETER_VALUE');

        }

        if (!$schema->hasTable('coefficient_to_base')){
            $table = $schema->createTable('coefficient_to_base');

            $table->addColumn('coefficient_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('width', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('height', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('value_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('coefficient_value', 'float', ['notnull' => true]);

            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);

            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['value_id'], 'coefficient_to_base_value');

            $table->setPrimaryKey(['coefficient_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения коэффициентов к базе для просчёт цены');

            $table->addForeignKeyConstraint('parameter_value', ['value_id'], ['value_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_COEFFICIENT_TO_BASE_PARAMETER_VALUE');

        }

    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('product_type_parameter')){
            $table = $schema->getTable('product_type_parameter');

            if ($table->hasColumn('is_initial')){
                $table->dropColumn('is_initial');
            }

            if ($table->hasColumn('is_basic')){
                $table->dropColumn('is_basic');
            }
        }

        if ($schema->hasTable('price_for_dimension')){
            if ($schema->getTable('price_for_dimension')->hasForeignKey('FK_PRICE_FOR_DIMENSION_PARAMETER_VALUE')) {
                $schema->getTable('price_for_dimension')->removeForeignKey('FK_PRICE_FOR_DIMENSION_PARAMETER_VALUE');
            }
            $schema->dropTable('price_for_dimension');
        }

        if ($schema->hasTable('coefficient_to_base')){
            if ($schema->getTable('coefficient_to_base')->hasForeignKey('FK_COEFFICIENT_TO_BASE_PARAMETER_VALUE')) {
                $schema->getTable('coefficient_to_base')->removeForeignKey('FK_COEFFICIENT_TO_BASE_PARAMETER_VALUE');
            }
            $schema->dropTable('coefficient_to_base');
        }
    }
}
