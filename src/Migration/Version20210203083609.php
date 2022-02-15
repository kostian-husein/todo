<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210203083609 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('calculator_statistic')) {
            $table = $schema->getTable('calculator_statistic');

            $table->addColumn('user_name', 'string', ['notnull' => true, 'length' => 100]);
            $table->addColumn('role', 'string', ['notnull' => false, 'length' => 100]);
            $table->addColumn('permission', 'text', ['notnull' => false]);
        }
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('calculator_statistic')) {
            $table = $schema->getTable('calculator_statistic');

            $table->dropColumn('user_name');
            $table->dropColumn('role');
            $table->dropColumn('permission');
        }
    }
}
