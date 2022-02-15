<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 13.02.2020
 * Time: 10:49
 * Project: steellinevds
 */

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Creates user table
 */
final class Version20200213072557 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) : void
    {
        if (! $schema->hasTable('user')) {
            $table = $schema->createTable('user');
            $table->addColumn('user_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('email', 'string', ['notnull' => true]);
            $table->addColumn('login', 'string', ['notnull' => false, 'default' => null]);
            $table->addColumn('roles', 'json', ['notnull' => true]);
            $table->addColumn('phone', 'string', ['notnull' => false, 'default' => null, 'length' => 20]);
            $table->addColumn('password', 'string', ['notnull' => true]);
            $table->addColumn('first_name', 'string', ['notnull' => true]);
            $table->addColumn('last_name', 'string', ['notnull' => true]);
            $table->addColumn('patronymic', 'string', ['notnull' => true]);
            $table->addColumn('address', 'json', ['notnull' => false, 'default' => null]);
            $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('last_activity', 'datetime', ['notnull' => false, 'default' => null]);
            $table->addColumn('country_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('region_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('city_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('parent_user_id', 'integer', ['unsigned' => true, 'notnull' => false, 'default' => null]);
            $table->addColumn('created_by_user_id', 'integer', ['unsigned' => true, 'notnull' => false, 'default' => null]);
            $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => false, 'default' => null]);
            $table->addColumn('path', 'string', ['notnull' => true]);
            $table->addColumn('external_id', 'string', ['notnull' => false, 'default' => null]);

            $table->setPrimaryKey(['user_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения пользователей');

            $table->addUniqueIndex(['email'], 'email');
            $table->addUniqueIndex(['login'], 'login');
            $table->addUniqueIndex(['phone'], 'phone');
            $table->addIndex(['is_active'], 'is_active');
            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['country_id'], 'country_id');
            $table->addIndex(['region_id'], 'region_id');
            $table->addIndex(['city_id'], 'city_id');
            $table->addIndex(['parent_user_id'], 'parent_user_id');
            $table->addIndex(['created_by_user_id'], 'created_by_user_id');
            $table->addIndex(['last_user_id'], 'last_user_id');
            $table->addUniqueIndex(['external_id'], 'external_id');

            $table->addForeignKeyConstraint('country', ['country_id'], ['country_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_COUNTRY');
            $table->addForeignKeyConstraint('region', ['region_id'], ['region_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_REGION');
            $table->addForeignKeyConstraint('city', ['city_id'], ['city_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_CITY');
            $table->addForeignKeyConstraint('user', ['parent_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_PARENT_USER');
            $table->addForeignKeyConstraint('user', ['created_by_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_CREATED_BY_USER');
            $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_LAST_USER');
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('user')) {
            $table = $schema->getTable('user');

            if ($table->hasForeignKey('FK_USER_COUNTRY')) {
                $table->removeForeignKey('FK_USER_COUNTRY');
            }

            if ($table->hasForeignKey('FK_USER_REGION')) {
                $table->removeForeignKey('FK_USER_REGION');
            }

            if ($table->hasForeignKey('FK_USER_CITY')) {
                $table->removeForeignKey('FK_USER_CITY');
            }

            if ($table->hasForeignKey('FK_USER_PARENT_USER')) {
                $table->removeForeignKey('FK_USER_PARENT_USER');
            }

            if ($table->hasForeignKey('FK_USER_CREATED_BY_USER')) {
                $table->removeForeignKey('FK_USER_CREATED_BY_USER');
            }

            if ($table->hasForeignKey('FK_USER_LAST_USER')) {
                $table->removeForeignKey('FK_USER_LAST_USER');
            }

            $schema->dropTable('user');
        }
    }
}
