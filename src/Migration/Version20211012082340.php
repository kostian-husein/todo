<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211012082340 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        if (! $schema->hasTable('nomenclature_group')) {
            $table = $schema->createTable('nomenclature_group');

            $table->addColumn('group_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('external_id', 'string', ['notnull' => true, 'length' => 255]);
            $table->addColumn('label', 'string', ['notnull' => true, 'length' => 255]);

            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);

            $table->setPrimaryKey(['group_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения видов номенклатуры');

            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['is_active'], 'is_active');
            $table->addUniqueIndex(['external_id'], 'external_id');
        }

        if (! $schema->hasTable('nomenclature_value')) {
            $table = $schema->createTable('nomenclature_value');

            $table->addColumn('nomenclature_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('external_id', 'string', ['notnull' => true, 'length' => 255]);
            $table->addColumn('group_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('label', 'string', ['notnull' => true, 'length' => 255]);
            $table->addColumn('price', 'decimal', ['unsigned' => true, 'notnull' => true, 'precision' => 20, 'scale' => 2, 'default' => 0]);
            $table->addColumn('measure', 'string', ['notnull' => true, 'length' => 255]);

            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);

            $table->setPrimaryKey(['nomenclature_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения значений номенклатуры');

            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['is_active'], 'is_active');
            $table->addIndex(['group_id'], 'group_id');
            $table->addUniqueIndex(['external_id'], 'external_id');

            $table->addForeignKeyConstraint('nomenclature_group', ['group_id'], ['group_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_NOMENCLATURE_VALUES_NOMENCLATURE_GROUP');
        }
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('nomenclature_group')) {
            $schema->dropTable('nomenclature_group');
        }
        if ($schema->hasTable('nomenclature_value')) {
            $schema->dropTable('nomenclature_value');
        }
    }
}
