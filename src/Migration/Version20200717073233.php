<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200717073233 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        if (! $schema->hasTable('dimension_rule')) {
            $table = $schema->createTable('dimension_rule');

            $table->addColumn('dimension_rule_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('parameter_value_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('rule', 'json', ['notnull' => true]);

            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => false, 'default' => null]);

            $table->setPrimaryKey(['dimension_rule_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения правил просчёта размеров');

            $table->addIndex(['parameter_value_id'], 'parameter_value_id');

            $table->addForeignKeyConstraint('parameter_value', ['parameter_value_id'], ['value_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_DIMENSION_RULE_PARAMETER_VALUE');
        }
    }

    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery("UPDATE country SET exchange_rate = 2.34 WHERE alias_key = 'Belarus'");
        $this->connection->executeQuery("UPDATE country SET exchange_rate = 71 WHERE alias_key = 'Russia'");
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('dimension_rule')) {
            $table = $schema->getTable('dimension_rule');

            if ($table->hasForeignKey('FK_DIMENSION_RULE_PARAMETER_VALUE')) {
                $table->removeForeignKey('FK_DIMENSION_RULE_PARAMETER_VALUE');
            }

            $schema->dropTable('dimension_rule');
        }
    }
}
