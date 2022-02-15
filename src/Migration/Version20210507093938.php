<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210507093938 extends AbstractMigration
{

    public function up(Schema $schema) : void
    {
        $this->connection->executeQuery("UPDATE `user` SET external_id = 'Director' WHERE user_id = 70");
    }

    public function down(Schema $schema) : void
    {
    }
}
