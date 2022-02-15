<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210406080913 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('error_report')) {
            $table = $schema->getTable('error_report');

            $table->changeColumn('company_id', ['notnull' => false]);
        }
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('error_report')) {
            $table = $schema->getTable('error_report');

            $table->changeColumn('company_id', ['notnull' => true]);
        }
    }
}
