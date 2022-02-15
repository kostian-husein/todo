<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200901100603 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {

    }

    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery("INSERT INTO role (last_user_id, label, priority, is_deleted, is_active) VALUES (1, 'ROLE_THE_GOD', 1, 0, 1)");
        $this->connection->executeQuery("INSERT INTO role (last_user_id, label, priority, is_deleted, is_active) VALUES (1, 'ROLE_CALCULATOR_USER', 1, 0, 1)");
        $this->connection->executeQuery("INSERT INTO role (last_user_id, label, priority, is_deleted, is_active) VALUES (1, 'ROLE_DISTRIBUTOR', 1, 0, 1)");
        $this->connection->executeQuery("INSERT INTO role (last_user_id, label, priority, is_deleted, is_active) VALUES (1, 'ROLE_DEALER', 1, 0, 1)");
        $this->connection->executeQuery("INSERT INTO role (last_user_id, label, priority, is_deleted, is_active) VALUES (1, 'ROLE_SUB_DEALER', 1, 0, 1)");
        $this->connection->executeQuery("INSERT INTO role (last_user_id, label, priority, is_deleted, is_active) VALUES (1, 'ROLE_SHOP_MANAGER', 1, 0, 1)");
        $this->connection->executeQuery("INSERT INTO role (last_user_id, label, priority, is_deleted, is_active) VALUES (1, 'ROLE_SUPER_ADMIN', 1, 0, 1)");
        $this->connection->executeQuery("INSERT INTO role (last_user_id, label, priority, is_deleted, is_active) VALUES (1, 'ROLE_ADMIN', 1, 0, 1)");
        $this->connection->executeQuery("INSERT INTO role (last_user_id, label, priority, is_deleted, is_active) VALUES (1, 'ROLE_USER', 1, 0, 1)");
        $this->connection->executeQuery("INSERT INTO role (last_user_id, label, priority, is_deleted, is_active) VALUES (1, 'ALL_SECTIONS', 1, 0, 1)");
        $this->connection->executeQuery("INSERT INTO role (last_user_id, label, priority, is_deleted, is_active) VALUES (1, 'SECTION_TRADE_OFFER_MANAGEMENT', 1, 0, 1)");
        $this->connection->executeQuery("INSERT INTO role (last_user_id, label, priority, is_deleted, is_active) VALUES (1, 'SECTION_TRADE_STORE_MANAGEMENT', 1, 0, 1)");
        $this->connection->executeQuery("INSERT INTO role (last_user_id, label, priority, is_deleted, is_active) VALUES (1, 'SECTION_SEO_MANAGEMENT', 1, 0, 1)");
        $this->connection->executeQuery("INSERT INTO role (last_user_id, label, priority, is_deleted, is_active) VALUES (1, 'ALL_ACTIONS', 1, 0, 1)");
        $this->connection->executeQuery("INSERT INTO role (last_user_id, label, priority, is_deleted, is_active) VALUES (1, 'ACTION_TRADE_OFFER_MANAGEMENT', 1, 0, 1)");
        $this->connection->executeQuery("INSERT INTO role (last_user_id, label, priority, is_deleted, is_active) VALUES (1, 'ACTION_TRADE_STORE_MANAGEMENT', 1, 0, 1)");
        $this->connection->executeQuery("INSERT INTO role (last_user_id, label, priority, is_deleted, is_active) VALUES (1, 'ACTION_SEO_MANAGEMENT', 1, 0, 1)");

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
