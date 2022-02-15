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

final class Version20200127060138 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        if (!$schema->hasTable('region')){
            $table = $schema->createTable('region');

            $table->addColumn('region_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('label', 'string', ['notnull' => true, 'length' => 255]);
            $table->addColumn('country_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('alias_key', 'string', ['notnull' => true, 'unique' => true]);

            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);

            $table->setPrimaryKey(['region_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения регионов страны');

            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['country_id'], 'country_id');

            $table->addForeignKeyConstraint('country', ['country_id'], ['country_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_REGION_COUNTRY');
        }

        if (!$schema->hasTable('region_coefficient')) {
            $table = $schema->createTable('region_coefficient');

            $table->addColumn('region_coefficient_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('region_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('value_id', 'integer', ['unsigned' => true, 'notnull' => true]);

            $table->addColumn('coefficient', 'float', ['notnull' => false]);
            $table->addColumn('coefficient_mark', 'float', ['notnull' => false]);

            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);

            $table->setPrimaryKey(['region_coefficient_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения коэффициентов регионов страны');

            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['value_id'], 'value_id');

            $table->addForeignKeyConstraint('parameter_value', ['value_id'], ['value_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_REGION_COEFFICIENT_PARAMETER_VALUE');
            $table->addForeignKeyConstraint('region', ['region_id'], ['region_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_COEFFICIENT_REGION_REGION');
        }

        if (!$schema->hasTable('city')){
            $table = $schema->createTable('city');

            $table->addColumn('city_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('label', 'string', ['notnull' => true, 'length' => 255]);
            $table->addColumn('region_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('alias_key', 'string', ['notnull' => true, 'unique' => true]);

            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);

            $table->setPrimaryKey(['city_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения городов региона');

            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['region_id'], 'region_id');

            $table->addForeignKeyConstraint('region', ['region_id'], ['region_id'], ['onDelete' => 'restrict', 'onUpdate'
            => 'restrict'], 'FK_CITY_REGION');
        }

        if (!$schema->hasTable('city_coefficient')) {
            $table = $schema->createTable('city_coefficient');

            $table->addColumn('city_coefficient_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('city_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('value_id', 'integer', ['unsigned' => true, 'notnull' => true]);

            $table->addColumn('coefficient', 'float', ['notnull' => false]);
            $table->addColumn('coefficient_mark', 'float', ['notnull' => false]);

            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);

            $table->setPrimaryKey(['city_coefficient_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения коэффициентов городов региона');

            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['value_id'], 'value_id');

            $table->addForeignKeyConstraint('parameter_value', ['value_id'], ['value_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_CITY_COEFFICIENT_PARAMETER_VALUE');
            $table->addForeignKeyConstraint('city', ['city_id'], ['city_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_COEFFICIENT_CITY_CITY');
        }

        if (!$schema->hasTable('country_coefficient')) {
            $table = $schema->createTable('country_coefficient');

            $table->addColumn('country_coefficient_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('country_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('value_id', 'integer', ['unsigned' => true, 'notnull' => true]);

            $table->addColumn('coefficient', 'float', ['notnull' => false]);
            $table->addColumn('coefficient_mark', 'float', ['notnull' => false]);

            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);

            $table->setPrimaryKey(['country_coefficient_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения коэффициентов для стран');

            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['value_id'], 'value_id');

            $table->addForeignKeyConstraint('parameter_value', ['value_id'], ['value_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_COUNTRY_COEFFICIENT_PARAMETER_VALUE');
            $table->addForeignKeyConstraint('country', ['country_id'], ['country_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_COEFFICIENT_COUNTRY_COUNTRY');
        }
    }

    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery('INSERT INTO region (country_id, label, alias_key) SELECT country_id, \'Центральный федеральный округ\', \'CFD\' FROM country WHERE alias_key = \'Russia\'');
        $this->connection->executeQuery('INSERT INTO region (country_id, label, alias_key) SELECT country_id, \'Северо-западный федеральный округ\', \'NWFD\' FROM country WHERE alias_key = \'Russia\'');
        $this->connection->executeQuery('INSERT INTO region (country_id, label, alias_key) SELECT country_id, \'Южный федеральный округ\', \'SFD\' FROM country WHERE alias_key = \'Russia\'');
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('region')) {
            $table = $schema->getTable('region');
            if ($table->hasForeignKey('FK_REGION_COUNTRY')) {
                $table->removeForeignKey('FK_REGION_COUNTRY');
            }
            $schema->dropTable('region');
        }

        if ($schema->hasTable('region_coefficient')) {
            $table = $schema->getTable('region_coefficient');
            if ($table->hasForeignKey('FK_REGION_COEFFICIENT_PARAMETER_VALUE')) {
                $table->removeForeignKey('FK_REGION_COEFFICIENT_PARAMETER_VALUE');
            }
            if ($table->hasForeignKey('FK_COEFFICIENT_REGION_REGION')) {
                $table->removeForeignKey('FK_COEFFICIENT_REGION_REGION');
            }
            $schema->dropTable('region_coefficient');
        }

        if ($schema->hasTable('city')) {
            $table = $schema->getTable('city');
            if ($table->hasForeignKey('FK_CITY_REGION')) {
                $table->removeForeignKey('FK_CITY_REGION');
            }
            $schema->dropTable('city');
        }

        if ($schema->hasTable('city_coefficient')) {
            $table = $schema->getTable('city_coefficient');
            if ($table->hasForeignKey('FK_CITY_COEFFICIENT_PARAMETER_VALUE')) {
                $table->removeForeignKey('FK_CITY_COEFFICIENT_PARAMETER_VALUE');
            }
            if ($table->hasForeignKey('FK_COEFFICIENT_CITY_CITY')) {
                $table->removeForeignKey('FK_COEFFICIENT_CITY_CITY');
            }
            $schema->dropTable('city_coefficient');
        }


        if ($schema->hasTable('country_coefficient')) {
            $table = $schema->getTable('country_coefficient');
            if ($table->hasForeignKey('FK_COUNTRY_COEFFICIENT_PARAMETER_VALUE')) {
                $table->removeForeignKey('FK_COUNTRY_COEFFICIENT_PARAMETER_VALUE');
            }
            if ($table->hasForeignKey('FK_COEFFICIENT_COUNTRY_COUNTRY')) {
                $table->removeForeignKey('FK_COEFFICIENT_COUNTRY_COUNTRY');
            }
            $schema->dropTable('country_coefficient');
        }
    }
}
