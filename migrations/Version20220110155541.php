<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220110155541 extends AbstractMigration
{

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        if($schema->hasTable('todo')){
           $this->addSql("ALTER TABLE todo CHANGE date_start created_at DATETIME");
        }
        // this up() migration is auto-generated, please modify it to your needs

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        if($schema->hasTable('todo')){
            $this->addSql("ALTER TABLE todo CHANGE created_at date_start DATETIME");
        }
        // this down() migration is auto-generated, please modify it to your needs

    }
}
