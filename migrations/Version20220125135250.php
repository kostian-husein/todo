<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220125135250 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        if($schema->hasTable('userActivityHistory')){
            $table = $schema->getTable('userActivityHistory');
            $table->addColumn('entity_name', 'string', ['length' => 250, 'notnull' => true]);
        }
        // this up() migration is auto-generated, please modify it to your needs

    }

    public function down(Schema $schema): void
    {
        if($schema->hasTable('userActivityHistory')){
            $table = $schema->getTable('userActivityHistory');
            $table->dropColumn('entity_name');
        }
        // this down() migration is auto-generated, please modify it to your needs

    }
}
