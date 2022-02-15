<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 10.02.2021
 * Time: 14:07
 * Project: steellinevds
 */

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Drop table "calculator_version", create table "changelog"
 */
final class Version20210210110613 extends AbstractMigration
{
    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('calculator_version')) {
            $table = $schema->getTable('calculator_version');

            if ($table->hasForeignKey('FK_CALCULATOR_UPDATE_LAST_USER')) {
                $table->removeForeignKey('FK_CALCULATOR_UPDATE_LAST_USER');
            }

            $schema->dropTable('calculator_version');
        }

        if (!$schema->hasTable('changelog')) {
            $table = $schema->createTable('changelog');
            $table->addColumn('id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('version', 'string', ['length' => 20, 'notnull' => true]);
            $table->addColumn('data', 'json', ['notnull' => true]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => false, 'default' => null]);

            $table->setPrimaryKey(['id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения записей об изменениях системы ВС');

            $table->addIndex(['last_user_id'], 'last_user_id');
            $table->addUniqueIndex(['version'], 'version');
            $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_CHANGELOG_LAST_USER');
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('changelog')) {
            $table = $schema->getTable('changelog');
            if ($table->hasForeignKey('FK_CHANGELOG_LAST_USER')) {
                $table->removeForeignKey('FK_CHANGELOG_LAST_USER');
            }

            $schema->dropTable('changelog');
        }

        if (!$schema->hasTable('calculator_version')) {
            $table = $schema->createTable('calculator_version');
            $table->addColumn('id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('version', 'string', ['length' => 20, 'notnull' => true]);
            $table->addColumn('description', 'text', ['notnull' => true]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => false, 'default' => null]);

            $table->setPrimaryKey(['id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения записей об обновлении калькулятора');

            $table->addIndex(['last_user_id'], 'last_user_id');
            $table->addUniqueIndex(['version'], 'version');
            $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_CALCULATOR_UPDATE_LAST_USER');
        }
    }
}
