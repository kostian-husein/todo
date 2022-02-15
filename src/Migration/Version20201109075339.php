<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201109075339 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        if ( ! $schema->hasTable('value_company')) {
            $table = $schema->createTable('value_company');

            $table->addColumn('id', 'integer', ['autoincrement' => true, 'unsigned' => true, 'notnull' => true]);
            $table->addColumn('value_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('company_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('label', 'string', ['notnull' => true, 'length' => 255]);

            $table->setPrimaryKey(['id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения значений параметра для разных компаний');

            $table->addIndex(['value_id'], 'value_id');
            $table->addIndex(['company_id'], 'company_id');
            $table->addUniqueIndex(['value_id', 'company_id'], 'uniq_value_id_company_id');

            $table->addForeignKeyConstraint('parameter_value', ['value_id'], ['value_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_VALUE_COMPANY_PARAMETER_VALUE_ID');
            $table->addForeignKeyConstraint('company', ['company_id'], ['company_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_VALUE_COMPANY_COMPANY_ID');
        }
    }

    public function postUp(Schema $schema): void
    {
        if ($schema->getTable('parameter_value')->hasColumn('print_label')) {
            $this->connection->executeQuery('INSERT INTO value_company (value_id, company_id, label) SELECT pv.value_id, 1, pv.print_label FROM parameter_value pv WHERE pv.print_label IS NOT NULL');
        }

        $this->connection->executeQuery("INSERT INTO value_company (value_id, company_id, label) SELECT pv.value_id, 2, REPLACE(pv.label, 'SteelTex', 'Sunorit') FROM parameter_value pv WHERE label LIKE '%SteelTex%'");
        $this->connection->executeQuery("INSERT INTO value_company (value_id, company_id, label) SELECT pv.value_id, 2, REPLACE(pv.label, 'Bjork', 'SunWood') FROM parameter_value pv WHERE label LIKE '%Bjork%'");
        $this->connection->executeQuery("INSERT INTO value_company (value_id, company_id, label) SELECT pv.value_id, 2, REPLACE(pv.label, 'SteelLak', 'SunLak') FROM parameter_value pv WHERE label LIKE '%SteelLak%'");
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('value_company')) {
            $table = $schema->getTable('value_company');
            if ($table->hasForeignKey('FK_VALUE_COMPANY_PARAMETER_VALUE_ID')) {
                $table->removeForeignKey('FK_VALUE_COMPANY_PARAMETER_VALUE_ID');
            }
            if ($table->hasForeignKey('FK_VALUE_COMPANY_COMPANY_ID')) {
                $table->removeForeignKey('FK_VALUE_COMPANY_COMPANY_ID');
            }
            $schema->dropTable('value_company');
        }
    }
}
