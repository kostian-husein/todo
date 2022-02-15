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
final class Version20190823060003 extends AbstractMigration
{

    public function up(Schema $schema) : void
    {
        if (!$schema->hasTable('country')){
            $table = $schema->createTable('country');

            $table->addColumn('country_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('label', 'string', ['notnull' => true, 'length' => 255]);
            $table->addColumn('exchange_rate', 'float', ['notnull' => true]);
            $table->addColumn('currency', 'string', ['notnull' => true, 'length' => 255]);

            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);

            $table->setPrimaryKey(['country_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица со странами стран для калькулятора');

            $table->addIndex(['is_deleted'], 'is_deleted');
        }

        if (!$schema->hasTable('country_extra_charge')){
            $table = $schema->createTable('country_extra_charge');

            $table->addColumn('extra_charge_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('value_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('country_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('extra_charge', 'float', ['notnull' => true]);

            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);

            $table->setPrimaryKey(['extra_charge_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения наценок для цен');

            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['country_id'], 'country_id');
            $table->addIndex(['value_id'], 'value_id');

            $table->addForeignKeyConstraint('country', ['country_id'], ['country_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_COUNTRY_EXTRA_CHARGE_COUNTRY');
            $table->addForeignKeyConstraint('parameter_value', ['value_id'], ['value_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_COUNTRY_EXTRA_CHARGE_PARAMETER_VALUE');
        }
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('country')){

            $schema->dropTable('country');
        }

        if ($schema->hasTable('country_extra_charge')){
            $table = $schema->getTable('country_extra_charge');

            if ($table->hasForeignKey('FK_COUNTRY_EXTRA_CHARGE_COUNTRY')){
                $table->removeForeignKey('FK_COUNTRY_EXTRA_CHARGE_COUNTRY');
            }
            if ($table->hasForeignKey('FK_COUNTRY_EXTRA_CHARGE_PARAMETER_VALUE')){
                $table->removeForeignKey('FK_COUNTRY_EXTRA_CHARGE_PARAMETER_VALUE');
            }

            $schema->dropTable('country_extra_charge');
        }

    }
}
