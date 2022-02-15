<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210623121133 extends AbstractMigration
{

    public function up(Schema $schema): void
    {
    }

    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery("DELETE FROM order_status WHERE external_id IS NOT NULL AND status_id <> 3;");
        $this->connection->executeQuery("ALTER TABLE order_status DROP COLUMN external_id;");
        $this->connection->executeQuery("INSERT INTO order_status (last_user_id, label, system_status, alias_code) VALUES (288, 'Завершен', 0, 'closed');");
    }

    public function down(Schema $schema): void
    {
    }
}
