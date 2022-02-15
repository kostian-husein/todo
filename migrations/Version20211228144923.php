<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211228144923 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        if ( $schema->hasTable('usersTodo') ) {

            $this->addSql('ALTER TABLE usersTodo ADD roles JSON NOT NULL');


        }
        // this up() migration is auto-generated, please modify it to your needs

    }

    public function down(Schema $schema): void
    {
        if ( $schema->hasTable('userTodo') ) {
            $table = $schema->getTable('userTodo');
            $table->dropColumn('roles');
        }
        // this down() migration is auto-generated, please modify it to your needs

    }
}
