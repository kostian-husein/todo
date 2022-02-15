<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201116121301 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('calculator_statistic')) {
            $table = $schema->getTable('calculator_statistic');

            if (!$table->hasColumn('plant_price')) {
                $table->addColumn('plant_price', 'integer', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
                $table->addColumn('sum_plant_price', 'integer', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            }
        }
    }

    public function postUp(Schema $schema): void
    {
        if ($schema->getTable('calculator_statistic')->hasColumn('geo')) {
            $this->connection->executeQuery('UPDATE calculator_statistic SET geo=NULL WHERE geo IS NOT NULL AND length(geo)=4');
            $this->connection->executeQuery('UPDATE calculator_statistic SET geo=NULL WHERE geo IS NOT NULL AND length(geo)=47');
        }
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('calculator_statistic')) {
            $table = $schema->getTable('calculator_statistic');

            $table->dropColumn('plant_price');
            $table->dropColumn('sum_plant_price');
        }
    }
}
