<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220121171052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        if(!$schema->hasTable('userActivityHistory')){
            $table = $schema->createTable('userActivityHistory');

            $table->addColumn('id', 'integer', ['notnull' => true, 'unsigned' => true, 'autoincrement' => true]);
            $table->addColumn('user', 'integer', ['unsigned' => true, 'notnull' => false]);
            $table->addColumn('activity', 'integer', ['unsigned' => true, 'notnull' => false]);

            $table->setPrimaryKey(['id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Activity users table');

        }

        if(!$schema->hasTable('userActivityName')){
            $table = $schema->createTable('userActivityName');

            $table->addColumn('id', 'integer', ['notnull' => true, 'unsigned' => true, 'autoincrement' => true]);
            $table->addColumn('activity_name', 'string', ['length' => 250, 'notnull' => false]);

            $table->setPrimaryKey(['id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Name activity table');

        }
        // this up() migration is auto-generated, please modify it to your needs

    }

    public function down(Schema $schema): void
    {
        if($schema->hasTable('userActivityHistory')){
            $schema->dropTable('userActivityHistory');

        }
        if($schema->hasTable('userActivityName')){
            $schema->dropTable('userActivityName');

        }
        // this down() migration is auto-generated, please modify it to your needs

    }
}
