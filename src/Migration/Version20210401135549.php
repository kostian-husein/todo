<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210401135549 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('error_report')) {
            $table = $schema->getTable('error_report');

            $table->addColumn('entity', 'string', ['notnull' => true, 'length' => 255]);
        }
    }

    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery("UPDATE `error_report` SET entity='calculator'");
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('error_report')) {
            $table = $schema->getTable('error_report');

            $table->dropColumn('entity');
        }
    }
}
