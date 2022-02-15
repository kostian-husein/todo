<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211223144627 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        if ( !$schema->hasTable('users') ) {
            $table = $schema->createTable('users');

            $table->addColumn('user_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true ]);
            $table->addColumn('login', 'string', ['length' => 25, 'notnull' => true]);
            $table->addColumn('password', 'string', ['length' => 25, 'notnull' => true ]);
            $table->addColumn('first_name', 'string', ['length' => 50, 'notnull' => true ]);
            $table->addColumn('last_name', 'string', ['length' => 50, 'notnull' => true ]);
            $table->addColumn('email', 'string', ['length' => 80, 'notnull' => true ]);
            $table->addColumn('phone', 'string', ['length' => 20, 'notnull' => true]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);
            $table->addColumn('is_deleted', 'boolean', ['notnull' => true, 'unsigned' => 'true', 'default' => 0]);

            $table->setPrimaryKey(['user_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Users ToDo list');
        }
    }

    public function down(Schema $schema): void
    {
        if($schema->hasTable('users') ) {

            $schema->dropTable('users');

        }
    }
}
