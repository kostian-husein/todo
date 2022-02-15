<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200810065654 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        if (!$schema->hasTable('error_report_comment')) {
            $table = $schema->createTable('error_report_comment');

            $table->addColumn('comment_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('user_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('report_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('comment', 'text', ['notnull' => true]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);

            $table->setPrimaryKey(['comment_id']);
            $table->addIndex(['user_id'], 'user_id');
            $table->addIndex(['report_id'], 'report_id');
            $table->addIndex(['is_active'], 'is_active');
            $table->addIndex(['is_deleted'], 'is_deleted');

            $table->addForeignKeyConstraint('user', ['user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_COMMENT');
            $table->addForeignKeyConstraint('error_report', ['report_id'], ['report_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_REPORT_COMMENT');
        }

        if ($schema->hasTable('error_report')) {
            $table = $schema->getTable('error_report');
            $table->addColumn('status', 'string', ['notnull' => true, 'default' => 'active']);
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\DBALException
     */
    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery("ALTER TABLE `error_report` MODIFY `status` ENUM('active', 'closed', 'rejected') NOT NULL DEFAULT 'active';");
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('error_report_comment')) {
            $table = $schema->getTable('error_report_comment');

            if ($table->hasForeignKey('FK_REPORT_COMMENT')) {
                $table->removeForeignKey('FK_REPORT_COMMENT');
            }
            if ($table->hasForeignKey('FK_USER_COMMENT')) {
                $table->removeForeignKey('FK_USER_COMMENT');
            }
            $table->dropIndex('is_deleted');
            $table->dropIndex('is_active');
            $table->dropIndex('report_id');
            $table->dropIndex('user_id');

            $schema->dropTable('error_report_comment');
        }

        if ($schema->hasTable('error_report')) {
            $table = $schema->getTable('error_report');
            if ($table->hasColumn('status')) {
                $table->dropColumn('status');
            }
        }
    }
}
