<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 28.01.2020
 * Time: 18:11
 * Project: steellinevds
 */

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Creates sync_log table
 */
final class Version20200128193905 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) : void
    {
        if (!$schema->hasTable('sync')) {
            $table = $schema->createTable('sync');

            $table->addColumn('sync_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('status', 'string', ['notnull' => true]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);

            $table->setPrimaryKey(['sync_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения записей о синхронизации с 1С');
        }

        if (!$schema->hasTable('sync_log')) {
            $table = $schema->createTable('sync_log');

            $table->addColumn('log_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('sync_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('type', 'string', ['notnull' => true]);
            $table->addColumn('text', 'text', ['notnull' => true]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);

            $table->setPrimaryKey(['log_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения логов синхронизации с 1С');
            $table->addIndex(['sync_id'], 'sync_id');
            $table->addForeignKeyConstraint('sync', ['sync_id'], ['sync_id'], ['onDelete' => 'cascade', 'onUpdate' => 'cascade'], 'FK_SYNC_LOG_SYNC_ID');
        }

        if (!$schema->hasTable('daemon_task')) {
            $table = $schema->createTable('daemon_task');

            $table->addColumn('task_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('command', 'string', ['notnull' => true]);
            $table->addColumn('args', 'json', ['notnull' => true]);
            $table->addColumn('is_completed', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);

            $table->setPrimaryKey(['task_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения логов синхронизации с 1С');
            $table->addIndex(['is_completed'], 'is_completed');
            $table->addIndex(['is_deleted'], 'is_deleted');
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\DBALException
     */
    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery('ALTER TABLE sync MODIFY status ENUM("created", "uploading", "processing", "success", "error") NOT NULL DEFAULT "created"');
        $this->connection->executeQuery('ALTER TABLE sync_log MODIFY type ENUM("info", "error") NOT NULL DEFAULT "info"');
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('sync_log')) {
            $table = $schema->getTable('sync_log');

            if ($table->hasForeignKey('FK_SYNC_LOG_SYNC_ID')) {
                $table->removeForeignKey('FK_SYNC_LOG_SYNC_ID');
            }

            $schema->dropTable('sync_log');
        }

        if ($schema->hasTable('sync')) {
            $schema->dropTable('sync');
        }

        if ($schema->hasTable('daemon_task')) {
            $schema->dropTable('daemon_task');
        }
    }
}
