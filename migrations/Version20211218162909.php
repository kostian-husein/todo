<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211218162909 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    /**
     * @param Schema $schema
     */

    public function up(Schema $schema): void
    {
        if($schema->hasTable('todo')) {

            $this->addSql("INSERT INTO todo (id, is_active, name_reminder, text_reminder) VALUES (1, 1 , 'first remind' , 'text first remind')" );

        }

        // this up() migration is auto-generated, please modify it to your needs

    }

    /**
     * @param Schema $schema
     */

    public function down(Schema $schema): void
    {
        if($schema->hasTable('todo')) {
            $this->addSql('DELETE FROM todo');
        }

        // this down() migration is auto-generated, please modify it to your needs

    }
}
