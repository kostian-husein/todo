<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211103125256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add new permission ROLE_CAN_ENTER_CODE_MANUALLY';
    }

    public function up(Schema $schema): void
    {
    }

    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery("INSERT INTO `permission` (`last_user_id`, `label`, `code`) VALUE (1, 'Может вводить номер заказа вручную', 'ROLE_CAN_ENTER_CODE_MANUALLY')");
    }

    public function down(Schema $schema): void
    {
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Exception
     */
    public function postDown(Schema $schema): void
    {
        $this->connection->executeQuery("DELETE FROM `permission` WHERE `code` = 'ROLE_CAN_ENTER_CODE_MANUALLY'");
    }
}
