<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210202081847 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->connection->executeQuery("UPDATE `parameter` SET alias_key = 'wrap' WHERE external_id = '24d9a80d-42cd-11e3-a771-001e671968b0'");
        $this->connection->executeQuery("UPDATE `parameter` SET alias_key = 'customHandleHeight' WHERE external_id = '5dcd7f66-15dc-41a7-bc3c-34eccce8b651'");
        $this->connection->executeQuery("UPDATE `parameter` SET alias_key = 'locksCombination' WHERE external_id = '8b4abf20-3fed-4911-b6c9-ac72f2727bfe'");
        $this->connection->executeQuery("UPDATE `parameter` SET alias_key = 'nonStandardPlatband' WHERE external_id = 'f1345d37-256c-4c5e-a799-f7db77ec48e2'");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
