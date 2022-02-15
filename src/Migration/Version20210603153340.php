<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210603153340 extends AbstractMigration
{
    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function up(Schema $schema): void
    {
        if (!$schema->hasTable('comment_file')) {
            $table = $schema->createTable('comment_file');

            $table->addColumn('id', 'integer', ['autoincrement' => true, 'unsigned' => true, 'notnull' => true]);
            $table->addColumn('comment_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('file', 'string', ['notnull' => true, 'length' => 255, 'default' => null]);
            $table->addColumn('real_filename', 'string', ['notnull' => false, 'length' => 255]);
            $table->addColumn('file_size', 'integer', ['unsigned' => true, 'notnull' => false]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);

            $table->addIndex(['comment_id'], 'comment_id');
            $table->addIndex(['is_deleted'], 'is_deleted');

            $table->addUniqueIndex(['id'], 'id');
            $table->setPrimaryKey(['id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения файлов для комментариев заказа');

            $table->addForeignKeyConstraint('order_comment', ['comment_id'], ['comment_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_COMMENT_ORDER');
        }
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('comment_file')) {
            $schema->dropTable('comment_file');
        }
    }
}
