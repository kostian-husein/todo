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
final class Version20190504111944 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) : void
    {
        if (!$schema->hasTable('product_type')) {
            $table = $schema->createTable('product_type');

            $table->addColumn('product_type_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('label', 'string', ['notnull' => true, 'length' => 255]);
            $table->addColumn('short_label', 'string', ['notnull' => true, 'length' => 10]);
            $table->addColumn('external_id', 'string', ['notnull' => true, 'length' => 255]);

            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);

            $table->setPrimaryKey(['product_type_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения типов продукции');

            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addUniqueIndex(['external_id'], 'external_id');
        }

        if (!$schema->hasTable('parameter')) {
            $table = $schema->createTable('parameter');

            $table->addColumn('parameter_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('label', 'string', ['notnull' => true, 'length' => 255]);
            $table->addColumn('external_id', 'string', ['notnull' => true, 'length' => 255]);
            $table->addColumn('is_link', 'boolean', ['unsigned' => true, 'notnull' => true]);

            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);

            $table->setPrimaryKey(['parameter_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для параметров двери');

            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['is_link'], 'is_link');
            $table->addUniqueIndex(['external_id'], 'external_id');
        }

        if (!$schema->hasTable('product_type_parameter')){
            $table = $schema->createTable('product_type_parameter');

            $table->addColumn('product_type_parameter_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('product_type_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('parameter_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('external_id', 'string', ['notnull' => true, 'length' => 255]);

            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);

            $table->setPrimaryKey(['product_type_parameter_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения параметров для различных типов продукции');

            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['product_type_id'], 'product_type_id');
            $table->addIndex(['parameter_id'], 'parameter_id');
            $table->addUniqueIndex(['product_type_id', 'parameter_id'], 'uniq_product_type_parameter_id');
            $table->addUniqueIndex(['external_id'], 'external_id');

            $table->addForeignKeyConstraint('product_type', ['product_type_id'], ['product_type_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_PRODUCT_TYPE_PARAMETER_PRODUCT_TYPE');
            $table->addForeignKeyConstraint('parameter', ['parameter_id'], ['parameter_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_PRODUCT_TYPE_PARAMETER_PARAMETER');
        }

        if (!$schema->hasTable('parameter_value')) {
            $table = $schema->createTable('parameter_value');

            $table->addColumn('value_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('label', 'string', ['notnull' => true, 'length' => 255]);
            $table->addColumn('product_type_parameter_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('external_id', 'string', ['notnull' => true, 'length' => 255]);

            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);

            $table->setPrimaryKey(['value_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения значений параметров');

            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['product_type_parameter_id'], 'product_type_parameter_id');
            $table->addUniqueIndex(['external_id'], 'external_id');

            $table->addForeignKeyConstraint('product_type_parameter', ['product_type_parameter_id'], ['product_type_parameter_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_PARAMETER_VALUE_PRODUCT_TYPE_PARAMETER');
        }

        if (!$schema->hasTable('parameter_dependencies')){
            $table = $schema->createTable('parameter_dependencies');

            $table->addColumn('dependence_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('dependent_parameter_id','integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('product_type_parameter_id','integer', ['unsigned' => true, 'notnull' => true]);

            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);

            $table->setPrimaryKey(['dependence_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения зависимостей параметров двери');

            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['product_type_parameter_id'], 'product_type_parameter_id');
            $table->addIndex(['dependent_parameter_id'], 'dependent_parameter_id');
            $table->addUniqueIndex(['dependent_parameter_id', 'product_type_parameter_id'], 'uniq_dep_param_id_pt_param_id');

            $table->addForeignKeyConstraint('product_type_parameter', ['product_type_parameter_id'], ['product_type_parameter_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_PARAMETER_DEPENDENCE_PRODUCT_TYPE_PARAMETER');
            $table->addForeignKeyConstraint('product_type_parameter', ['dependent_parameter_id'], ['product_type_parameter_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_PARAMETER_DEPENDENCE_PRODUCT_TYPE_PARAMETER_DEPENDENT');
        }

        if (!$schema->hasTable('attendant_parameter')){
            $table = $schema->createTable('attendant_parameter');

            $table->addColumn('id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('product_type_parameter_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('value_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('attendant_parameter_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('attendant_value_id', 'integer', ['unsigned' => true, 'notnull' => false]);
            $table->addColumn('can_change', 'boolean', ['notnull' => true]);

            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);

            $table->setPrimaryKey(['id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения сопутствующих значений параметров');

            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['product_type_parameter_id'], 'product_type_parameter_id');
            $table->addIndex(['attendant_parameter_id'], 'attendant_parameter_id');
            $table->addIndex(['value_id'], 'value_id');
            $table->addIndex(['attendant_value_id'], 'attendant_value_id');
            $table->addUniqueIndex(['product_type_parameter_id', 'value_id', 'attendant_parameter_id', 'attendant_value_id'], 'uniq_params_values');

            $table->addForeignKeyConstraint('product_type_parameter', ['product_type_parameter_id'], ['product_type_parameter_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_PARAMETER_TYPE_PRODUCT__ATTENDANT_PARAMETER');
            $table->addForeignKeyConstraint('product_type_parameter', ['attendant_parameter_id'], ['product_type_parameter_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_PARAMETER_TYPE_PRODUCT_ATTEND_PARAMETER');
            $table->addForeignKeyConstraint('parameter_value', ['value_id'], ['value_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_PARAMETER_VALUE_ATTENDANT_PARAMETER');
            $table->addForeignKeyConstraint('parameter_value', ['attendant_value_id'], ['value_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_PARAMETER_VALUE_ATTEND_PARAMETER');
        }

        if (!$schema->hasTable('parameter_price')){
            $table = $schema->createTable('parameter_price');

            $table->addColumn('parameter_price_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('parameter_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('value_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('price', 'decimal', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('condition', 'string', ['notnull' => true, 'length' => 510]);

            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);

            $table->setPrimaryKey(['parameter_price_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения цен для параметров');

            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['parameter_id'], 'parameter_price_parameter_id');
            $table->addIndex(['value_id'], 'parameter_price_value');
            $table->addUniqueIndex(['parameter_id', 'value_id'], 'uniq_parameter_id_value_id');

            $table->addForeignKeyConstraint('parameter', ['parameter_id'], ['parameter_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_PARAMETER_PARAMETER_PRICE');
            $table->addForeignKeyConstraint('parameter_value', ['value_id'], ['value_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_PARAMETER_VALUE_PARAMETER_PRICE');

        }

        if (!$schema->hasTable('parameter_condition')){
            $table = $schema->createTable('parameter_condition');

            $table->addColumn('condition_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('parameter_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('product_type_parameter_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('conditions', 'json', ['notnull' => true]);

            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);

            $table->setPrimaryKey(['condition_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения условий параметра');

            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['parameter_id'], 'parameter_id');
            $table->addIndex(['product_type_parameter_id'], 'product_type_parameter_id');
            $table->addUniqueIndex(['parameter_id', 'product_type_parameter_id'], 'uniq_parameter_id_product_type_parameter_id');

            $table->addForeignKeyConstraint('parameter', ['parameter_id'], ['parameter_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_PARAMETER_PARAMETER_CONDITION');
            $table->addForeignKeyConstraint('product_type_parameter', ['product_type_parameter_id'], ['product_type_parameter_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_PRODUCT_TYPE_PARAMETER_PARAMETER_CONDITION');
        }

        if (!$schema->hasTable('parameter_mandatory_condition')) {
            $table = $schema->createTable('parameter_mandatory_condition');

            $table->addColumn('condition_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('product_type_parameter_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('conditions', 'json', ['notnull' => true]);

            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);

            $table->setPrimaryKey(['condition_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения полей обязательных для заполнения при соблюдении условия');

            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addUniqueIndex(['product_type_parameter_id'], 'product_type_parameter_id');

            $table->addForeignKeyConstraint('product_type_parameter', ['product_type_parameter_id'], ['product_type_parameter_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_PRODUCT_TYPE_PARAMETER_REQUIRED_FIELD');
        }

        if (!$schema->hasTable('parameter_dimension')){
            $table = $schema->createTable('parameter_dimension');

            $table->addColumn('dimension_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('product_type_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('parameter', 'string', ['length' => 50, 'notnull' => true]);
            $table->addColumn('conditions', 'json', ['notnull' => true]);

            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);

            $table->setPrimaryKey(['dimension_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения размеров продукции');

            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['product_type_id'], 'product_type_id');
            $table->addIndex(['parameter'], 'parameter');

            $table->addForeignKeyConstraint('product_type', ['product_type_id'], ['product_type_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_PARAMETER_DIMENSION_PARAMETER_PARAMETER');
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('parameter_dependencies')) {
            $table = $schema->getTable('parameter_dependencies');

            if ($table->hasForeignKey('FK_PARAMETER_DEPENDENCE_PRODUCT_TYPE_PARAMETER')) {
                $table->removeForeignKey('FK_PARAMETER_DEPENDENCE_PRODUCT_TYPE_PARAMETER');
            }
            if ($table->hasForeignKey('FK_PARAMETER_DEPENDENCE_PRODUCT_TYPE_PARAMETER_DEPENDENT')) {
                $table->removeForeignKey('FK_PARAMETER_DEPENDENCE_PRODUCT_TYPE_PARAMETER_DEPENDENT');
            }

            $schema->dropTable('parameter_dependencies');
        }

        if ($schema->hasTable('parameter_price')) {
            $table = $schema->getTable('parameter_price');

            if ($table->hasForeignKey('FK_PARAMETER_PARAMETER_PRICE')) {
                $table->removeForeignKey('FK_PARAMETER_PARAMETER_PRICE');
            }
            if ($table->hasForeignKey('FK_PARAMETER_VALUE_ATTENDANT_PARAMETER')) {
                $table->removeForeignKey('FK_PARAMETER_VALUE_ATTENDANT_PARAMETER');
            }

            $schema->dropTable('parameter_price');
        }

        if ($schema->hasTable('parameter_condition')) {
            $table = $schema->getTable('parameter_condition');

            if ($table->hasForeignKey('FK_PARAMETER_PARAMETER_CONDITION')) {
                $table->removeForeignKey('FK_PARAMETER_PARAMETER_CONDITION');
            }

            $schema->dropTable('parameter_condition');
        }

        if ($schema->hasTable('attend_parameter')) {
            $table = $schema->getTable('attend_parameter');

            if ($table->hasForeignKey('FK_PARAMETER_ATTENDANT_PARAMETER')) {
                $table->removeForeignKey('FK_PARAMETER_ATTENDANT_PARAMETER');
            }
            if ($table->hasForeignKey('FK_PARAMETER_ATTEND_PARAMETER')) {
                $table->removeForeignKey('FK_PARAMETER_ATTEND_PARAMETER');
            }
            if ($table->hasForeignKey('FK_PARAMETER_VALUE_ATTENDANT_PARAMETER')) {
                $table->removeForeignKey('FK_PARAMETER_VALUE_ATTENDANT_PARAMETER');
            }
            if ($table->hasForeignKey('FK_PARAMETER_VALUE_ATTEND_PARAMETER')) {
                $table->removeForeignKey('FK_PARAMETER_VALUE_ATTEND_PARAMETER');
            }

            $schema->dropTable('attend_parameter');
        }

        if ($schema->hasTable('parameter_value')) {
            $table = $schema->getTable('parameter_value');

            if ($table->hasForeignKey('FK_PARAMETER_VALUE_PRODUCT_TYPE_PARAMETER')) {
                $table->removeForeignKey('FK_PARAMETER_VALUE_PRODUCT_TYPE_PARAMETER');
            }

            $schema->dropTable('parameter_value');
        }

        if ($schema->hasTable('product_type_parameter')) {
            $table = $schema->getTable('product_type_parameter');

            if ($table->hasForeignKey('FK_PRODUCT_TYPE_PARAMETER_PRODUCT_TYPE')) {
                $table->removeForeignKey('FK_PRODUCT_TYPE_PARAMETER_PRODUCT_TYPE');
            }
            if ($table->hasForeignKey('FK_PRODUCT_TYPE_PARAMETER_PARAMETER')) {
                $table->removeForeignKey('FK_PRODUCT_TYPE_PARAMETER_PARAMETER');
            }

            $schema->dropTable('product_type_parameter');
        }

        if ($schema->hasTable('parameter')) {
            $table = $schema->getTable('parameter');

            if ($table->hasForeignKey('FK_PARAMETER_PRODUCT')) {
                $table->removeForeignKey('FK_PARAMETER_PRODUCT');
            }

            $schema->dropTable('parameter');
        }

        if ($schema->hasTable('product_type')) {
            $schema->dropTable('product_type');
        }

        if ($schema->hasTable('parameter_mandatory_condition')) {
            $table = $schema->getTable('parameter_mandatory_condition');
            if ($table->hasForeignKey('FK_PRODUCT_TYPE_PARAMETER_REQUIRED_FIELD')) {
                $table->removeForeignKey('FK_PRODUCT_TYPE_PARAMETER_REQUIRED_FIELD');
            }
            $schema->dropTable('parameter_mandatory_condition');
        }

        if ($schema->hasTable('parameter_dimension')){
            $table = $schema->getTable('parameter_dimension');
            if ($table->hasForeignKey('FK_PARAMETER_DIMENSION_PRODUCT_TYPE')){
                $table->removeForeignKey('FK_PARAMETER_DIMENSION_PRODUCT_TYPE');
            }
            $schema->dropTable('parameter_dimension');
        }
    }
}
