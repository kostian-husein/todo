<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210916143819 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        if (!$schema->hasTable('notification_report')) {
            $table = $schema->createTable('notification_report');

            $table->addColumn('id', 'integer', ['autoincrement' => true, 'unsigned' => true, 'notnull' => true]);
            $table->addColumn('user_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('report_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);

            $table->addIndex(['user_id'], 'user_id');
            $table->addIndex(['report_id'], 'report_id');
            $table->addIndex(['is_active'], 'is_active');
            $table->addIndex(['is_deleted'], 'is_deleted');

            $table->addUniqueIndex(['user_id', 'report_id'], 'user_report_id');
            $table->setPrimaryKey(['id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения оповещений для отчетов об ошибках');

            $table->addForeignKeyConstraint('user', ['user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_REPORT_USER_NOTIFICATION');
            $table->addForeignKeyConstraint('error_report', ['report_id'], ['report_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_REPORT_NOTIFICATION');
        }
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('notification_report')) {
            $table = $schema->getTable('notification_report');
            if ($table->hasForeignKey('FK_REPORT_USER_NOTIFICATION')) {
                $table->removeForeignKey('FK_REPORT_USER_NOTIFICATION');
            }
            if ($table->hasForeignKey('FK_REPORT_NOTIFICATION')) {
                $table->removeForeignKey('FK_REPORT_NOTIFICATION');
            }
            $schema->dropTable('notification_report');
        }
    }
}
