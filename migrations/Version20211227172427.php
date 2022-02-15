<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211227172427 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function up(Schema $schema): void
    {
        if($schema->hasTable('users') ) {

            $schema->renameTable('users', 'usersTodo');

        }
        // this up() migration is auto-generated, please modify it to your needs

    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function down(Schema $schema): void
    {
        if($schema->hasTable('usersTodo') ) {

            $schema->renameTable('usersTodo', 'users');

        }
        // this down() migration is auto-generated, please modify it to your needs

    }
}
