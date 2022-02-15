<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220121152543 extends AbstractMigration
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
        if($schema->hasTable('todo')){
           $table = $schema->getTable('todo');
           $table->addColumn('user_id', 'integer', ['unsigned' => true, 'notnull' => false]);
        }
        // this up() migration is auto-generated, please modify it to your needs

    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function down(Schema $schema): void
    {
        if($schema->hasTable('todo')){
            $table = $schema->getTable('todo');
            $table->dropColumn('user_id');
        }
        // this down() migration is auto-generated, please modify it to your needs

    }
}
