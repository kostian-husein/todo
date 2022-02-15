<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201218055116 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {

    }

    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery('INSERT INTO city (region_id, label, alias_key) SELECT region_id, \'Петрозаводск\', \'Petrozavodsk\' FROM region WHERE alias_key = \'NWFD\'');
    }

    public function down(Schema $schema) : void
    {

    }
}
