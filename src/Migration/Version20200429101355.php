<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200429101355 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        if (!$schema->hasTable('mail_message')) {
            $table = $schema->createTable('mail_message');

            $table->addColumn('message_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('email', 'string', ['notnull' => true, 'length' => 255]);
            $table->addColumn('type', 'string', ['notnull' => true, 'length' => 255]);
            $table->addColumn('lang', 'string', ['notnull' => true, 'length' => 10]);
            $table->addColumn('priority', 'smallint', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('status', 'smallint', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('content', 'json', ['notnull' => true]);

            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            $table->setPrimaryKey(['message_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения писем');

            $table->addIndex(['is_deleted'], 'is_deleted');
        }
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('mail_message')){
            $schema->dropTable('mail_message');
        }
    }
}
