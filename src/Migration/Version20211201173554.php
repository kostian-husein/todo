<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211201173554 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'UPDATE ROLE_TESTER TO ROLE_CALL_MANAGER';
    }

    public function up(Schema $schema): void
    {
    }

    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery("UPDATE `permission` SET code='ROLE_CALL_MANAGER' WHERE code='ROLE_TESTER'");
    }

    public function down(Schema $schema): void
    {
    }

    public function postDown(Schema $schema): void
    {
        $this->connection->executeQuery("UPDATE `permission` SET code='ROLE_TESTER' WHERE code='ROLE_CALL_MANAGER'");
    }
}
