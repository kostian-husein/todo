<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201008085308 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('calculator_statistic')) {
            $table = $schema->getTable('calculator_statistic');

            $table->addColumn('price', 'float', ['notnull' => true, 'default' => 0]);
            $table->addColumn('coefficient', 'json', ['notnull' => false]);
            $table->addColumn('geo', 'json', ['notnull' => true]);
        }

        if ($schema->hasTable('error_report')) {
            $table = $schema->getTable('error_report');

            $table->addColumn('currency', 'string', ['notnull' => true, 'length' => 255]);
            $table->addColumn('coefficient', 'json', ['notnull' => false]);
            $table->addColumn('geo', 'json', ['notnull' => true]);
        }
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('calculator_statistic')) {
            $table = $schema->getTable('calculator_statistic');

            $table->dropColumn('price');
            $table->dropColumn('coefficient');
            $table->dropColumn('geo');
        }

        if ($schema->hasTable('error_report')) {
            $table = $schema->getTable('error_report');

            $table->dropColumn('currency');
            $table->dropColumn('coefficient');
            $table->dropColumn('geo');
        }
    }
}
