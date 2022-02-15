<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 11.06.2020
 * Time: 09:27
 * Project: vds
 */

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200608063941 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        if (! $schema->hasTable('permission')) {
            $table = $schema->createTable('permission');

            $table->addColumn('permission_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('label', 'string', ['notnull' => true, 'length' => 50]);
            $table->addColumn('code', 'string', ['notnull' => true, 'length' => 50]);

            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);
            $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => false, 'default' => null]);

            $table->setPrimaryKey(['permission_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения доступов');

            $table->addIndex(['last_user_id'], 'last_user_id');
            $table->addUniqueIndex(['label'], 'label');
            $table->addUniqueIndex(['code'], 'code');

            $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_PERMISSION');
        }

        if (! $schema->hasTable('role')) {
            $table = $schema->createTable('role');

            $table->addColumn('role_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);

            $table->addColumn('label', 'string', ['notnull' => true, 'length' => 50]);
            $table->addColumn('priority', 'smallint', ['unsigned' => true, 'notnull' => true, 'default' => 100]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);
            $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => false, 'default' => null]);

            $table->setPrimaryKey(['role_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения ролей');

            $table->addIndex(['last_user_id'], 'last_user_id');
            $table->addUniqueIndex(['label'], 'label');

            $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_ROLE');
        }

        if (! $schema->hasTable('user_role')) {
            $table = $schema->createTable('user_role');

            $table->addColumn('id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('user_id', 'integer', ['unsigned' => true, 'notnull' => false, 'default' => null]);
            $table->addColumn('role_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);

            $table->setPrimaryKey(['id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения связей роль -> пользователь');

            $table->addForeignKeyConstraint('user', ['user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_USER_ROLE');
            $table->addForeignKeyConstraint('role', ['role_id'], ['role_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_ROLE_ROLE');

        }

        if (! $schema->hasTable('role_permission')) {
            $table = $schema->createTable('role_permission');

            $table->addColumn('id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('role_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('permission_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);

            $table->setPrimaryKey(['id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения связей роль -> доступ');

            $table->addIndex(['role_id'], 'role_id');
            $table->addIndex(['permission_id'], 'permission_id');

            $table->addForeignKeyConstraint('role', ['role_id'], ['role_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_ROLE_ROLE_PERMISSION');
            $table->addForeignKeyConstraint('permission', ['permission_id'], ['permission_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_PERMISSION_ROLE_PERMISSION');
        }

        if (! $schema->hasTable('user_permission')) {
            $table = $schema->createTable('user_permission');

            $table->addColumn('id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('user_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('permission_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);

            $table->setPrimaryKey(['id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения связей пользователь -> доступ');

            $table->addIndex(['user_id'], 'user_id');
            $table->addIndex(['permission_id'], 'permission_id');

            $table->addForeignKeyConstraint('user', ['user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_USER_PERMISSION');
            $table->addForeignKeyConstraint('permission', ['permission_id'], ['permission_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_PERMISSION_USER_PERMISSION');
        }
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('permission')) {
            $table = $schema->getTable('permission');

            if ($table->hasForeignKey('FK_USER_PERMISSION')) {
                $table->removeForeignKey('FK_USER_PERMISSION');
            }

            $schema->dropTable('permission');
        }

        if ($schema->hasTable('role')) {
            $table = $schema->getTable('role');

            if ($table->hasForeignKey('FK_USER_ROLE')) {
                $table->removeForeignKey('FK_USER_ROLE');
            }

            $schema->dropTable('role');
        }

        if ($schema->hasTable('user_role')) {
            $table = $schema->getTable('user_role');

            if ($table->hasForeignKey('FK_USER_USER_ROLE')) {
                $table->removeForeignKey('FK_USER_USER_ROLE');
            }
            if ($table->hasForeignKey('FK_USER_ROLE_ROLE')) {
                $table->removeForeignKey('FK_USER_ROLE_ROLE');
            }

            $schema->dropTable('user_role');
        }

        if ($schema->hasTable('role_permission')) {
            $table = $schema->getTable('role_permission');

            if ($table->hasForeignKey('FK_ROLE_ROLE_PERMISSION')) {
                $table->removeForeignKey('FK_ROLE_ROLE_PERMISSION');
            }
            if ($table->hasForeignKey('FK_PERMISSION_ROLE_PERMISSION')) {
                $table->removeForeignKey('FK_PERMISSION_ROLE_PERMISSION');
            }

            $schema->dropTable('role_permission');
        }

        if ($schema->hasTable('user_permission')) {
            $table = $schema->getTable('user_permission');

            if ($table->hasForeignKey('FK_USER_USER_PERMISSION')) {
                $table->removeForeignKey('FK_USER_USER_PERMISSION');
            }
            if ($table->hasForeignKey('FK_PERMISSION_USER_PERMISSION')) {
                $table->removeForeignKey('FK_PERMISSION_USER_PERMISSION');
            }

            $schema->dropTable('user_permission');
        }
    }
}
