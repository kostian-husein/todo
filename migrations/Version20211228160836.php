<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211228160836 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        if ( $schema->hasTable('usersTodo') ) {
            $table = $schema->getTable('usersTodo');

            $table->changeColumn('password', ['length' => 256, 'notnull' => true ]);

        }
        // this up() migration is auto-generated, please modify it to your needs

    }

    public function down(Schema $schema): void
    {
        if ( $schema->hasTable('usersTodo') ) {
            $table = $schema->getTable('usersTodo');

            $table->changeColumn('password', ['length' => 25, 'notnull' => true ]);

        }
        // this down() migration is auto-generated, please modify it to your needs

    }
}
