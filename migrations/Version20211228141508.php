<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211228141508 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        if ( $schema->hasTable('user') ) {
            $table = $schema->getTable('user');

            $table->dropColumn('id');
            $table->addColumn('user_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true ]);
            $table->addColumn('login', 'string', ['length' => 25, 'notnull' => true]);
            $table->addColumn('password', 'string', ['length' => 25, 'notnull' => true ]);
            $table->addColumn('first_name', 'string', ['length' => 50, 'notnull' => true ]);
            $table->addColumn('last_name', 'string', ['length' => 50, 'notnull' => true ]);
            $table->addColumn('phone', 'string', ['length' => 20, 'notnull' => true]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);
            $table->addColumn('is_deleted', 'boolean', ['notnull' => true, 'unsigned' => 'true', 'default' => 0]);


        }
        // this up() migration is auto-generated, please modify it to your needs

    }

    public function down(Schema $schema): void
    {
        if ( $schema->hasTable('user') ) {
            $table = $schema->getTable('user');

            $table->addColumn('id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true ]);
            $table->dropColumn('login');
            $table->dropColumn('password');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('phone');
            $table->dropColumn('created_at');
            $table->dropColumn('is_active');
            $table->dropColumn('is_deleted');


        }
        // this down() migration is auto-generated, please modify it to your needs

    }
}
