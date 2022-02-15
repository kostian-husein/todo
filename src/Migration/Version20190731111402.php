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
final class Version20190731111402 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('parameter_value'))
        {
            $table = $schema->getTable('parameter_value');

            if (!$table->hasColumn('is_common'))
            {
                $table->addColumn('is_common', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
                $table->addIndex(['is_common'], 'is_common');
            }
        }

//        if (!$schema->hasTable('partners')){
//            $table = $schema->createTable('partners');
//
//            $table->addColumn('partner_id', 'integer',  ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
//            $table->addColumn('name', 'string', ['notnull' => true, 'length' => 255]);
//
//            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
//            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
//            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
//
//            $table->setPrimaryKey(['partner_id']);
//            $table->addOption('engine', 'InnoDB');
//            $table->addOption('comment', 'Таблица для хранения данных дистрибьюторов для калькулятора');
//
//            $table->addIndex(['is_deleted'], 'is_deleted');
//        }
//
//        if (!$schema->hasTable('partners_parameter_values_link')){
//            $table = $schema->createTable('partners_parameter_values_link');
//
//            $table->addColumn('ppv_link_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
//            $table->addColumn('value_id', 'integer', ['unsigned' => true, 'notnull' => true]);
//            $table->addColumn('partner_id', 'integer', ['unsigned' => true, 'notnull' => true]);
//
//            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
//            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
//            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
//
//            $table->setPrimaryKey(['ppv_link_id']);
//
//            $table->addOption('engine', 'InnoDB');
//            $table->addOption('comment', 'Таблица для хранения связи между значениями параметров и дистрибьюторами');
//
//            $table->addIndex(['is_deleted'], 'is_deleted');
//            $table->addUniqueIndex(['value_id', 'partner_id'], 'partner_parameter_value_id');
//
//            $table->addForeignKeyConstraint('partners', ['partner_id'], ['partner_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_PARAMETER_VALUES_LINK_PARTNERS');
//            $table->addForeignKeyConstraint('parameter_value', ['value_id'], ['value_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_PARAMETER_VALUES_LINK_PARAMETER_VALUE');
//        }
    }

    public function down(Schema $schema) : void
    {
//        if ($schema->hasTable('partners')){
//            $schema->dropTable('partners');
//        }

//        if ($schema->hasTable('partners_parameter_values_link')){
//            $table = $schema->getTable('partners_parameter_values_link');
//
//            if ($table->hasForeignKey('FK_PARAMETER_VALUES_LINK_PARTNERS')){
//                $table->removeForeignKey('FK_PARAMETER_VALUES_LINK_PARTNERS');
//            }
//            if ($table->hasForeignKey('FK_PARAMETER_VALUES_LINK_PARAMETER_VALUE')){
//                $table->removeForeignKey('FK_PARAMETER_VALUES_LINK_PARAMETER_VALUE');
//            }
//
//            $schema->dropTable('partners_parameter_values_link');
//        }

        if ($schema->hasTable('parameter_value')){
            $table = $schema->getTable('parameter_value');
            if ($table->hasColumn('is_common')) {
                $table->dropColumn('is_common');
            }
        }
    }
}
