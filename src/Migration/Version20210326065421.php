<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210326065421 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->connection->executeQuery("INSERT INTO `user_store`(user_id, store_id) SELECT `owner_id`, `store_id` FROM `store`");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
