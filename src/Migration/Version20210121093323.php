<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 21.01.2021
 * Time: 11:49
 * Project: steellinevds
 */

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Create user geo tables
 */
final class Version20210121093323 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription() : string
    {
        return 'Create user geo tables';
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) : void
    {
        if (!$schema->hasTable('user_country')) {
            $table = $schema->createTable('user_country');

            $table->addColumn('id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('user_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('country_id', 'integer', ['unsigned' => true, 'notnull' => true]);

            $table->setPrimaryKey(['id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения связей стран с пользователем');

            $table->addIndex(['user_id'], 'user_id');
            $table->addIndex(['country_id'], 'country_id');

            $table->addForeignKeyConstraint('user', ['user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_COUNTRY_USER');
            $table->addForeignKeyConstraint('country', ['country_id'], ['country_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_COUNTRY_COUNTRY');
        }

        if (!$schema->hasTable('user_region')) {
            $table = $schema->createTable('user_region');

            $table->addColumn('id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('user_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('region_id', 'integer', ['unsigned' => true, 'notnull' => true]);

            $table->setPrimaryKey(['id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения связей регионов с пользователем');

            $table->addIndex(['user_id'], 'user_id');
            $table->addIndex(['region_id'], 'region_id');

            $table->addForeignKeyConstraint('user', ['user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_REGION_USER');
            $table->addForeignKeyConstraint('region', ['region_id'], ['region_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_REGION_REGION');
        }

        if (!$schema->hasTable('user_city')) {
            $table = $schema->createTable('user_city');

            $table->addColumn('id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('user_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('city_id', 'integer', ['unsigned' => true, 'notnull' => true]);

            $table->setPrimaryKey(['id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения связей городов с пользователем');

            $table->addIndex(['user_id'], 'user_id');
            $table->addIndex(['city_id'], 'city_id');

            $table->addForeignKeyConstraint('user', ['user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_CITY_USER');
            $table->addForeignKeyConstraint('city', ['city_id'], ['city_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_CITY_CITY');
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('user_country')) {
            $table = $schema->getTable('user_country');

            if ($table->hasForeignKey('FK_USER_COUNTRY_USER')) {
                $table->removeForeignKey('FK_USER_COUNTRY_USER');
            }

            if ($table->hasForeignKey('FK_USER_COUNTRY_COUNTRY')) {
                $table->removeForeignKey('FK_USER_COUNTRY_COUNTRY');
            }

            $schema->dropTable('user_country');
        }

        if ($schema->hasTable('user_region')) {
            $table = $schema->getTable('user_region');

            if ($table->hasForeignKey('FK_USER_REGION_USER')) {
                $table->removeForeignKey('FK_USER_REGION_USER');
            }

            if ($table->hasForeignKey('FK_USER_REGION_REGION')) {
                $table->removeForeignKey('FK_USER_REGION_REGION');
            }

            $schema->dropTable('user_region');
        }

        if ($schema->hasTable('user_city')) {
            $table = $schema->getTable('user_city');

            if ($table->hasForeignKey('FK_USER_CITY_USER')) {
                $table->removeForeignKey('FK_USER_CITY_USER');
            }

            if ($table->hasForeignKey('FK_USER_CITY_CITY')) {
                $table->removeForeignKey('FK_USER_CITY_CITY');
            }

            $schema->dropTable('user_city');
        }
    }
}
