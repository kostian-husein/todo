<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211217182228 extends AbstractMigration
{

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */

    public function up(Schema $schema): void
    {
        if (!$schema->hasTable('todo') ) {

            $table = $schema->createTable('todo');

            $table->addColumn('id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true ]);
            $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            $table->addColumn('name_reminder', 'string', ['length' => 50]);
            $table->addColumn('text_reminder', 'string', ['notnull' => true, 'length' => 255]);
            $table->addColumn('date_start', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('date_end', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_deleted', 'boolean', ['notnull' => true, 'unsigned' => 'true', 'default' => 0]);

            $table->setPrimaryKey(['id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'ToDo list');

            $table->addIndex(['is_deleted'], 'is_delted');


        };
        // this up() migration is auto-generated, please modify it to your needs

    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */

    public function down(Schema $schema): void
    {
        if($schema->hasTable('todo') ) {

            $schema->dropTable('todo');

        }
        // this down() migration is auto-generated, please modify it to your needs

    }
}
