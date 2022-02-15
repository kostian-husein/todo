<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Add new permission ROLE_CAN_SET_MAIN_ORDER
 */
final class Version20211004101850 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add new permission ROLE_CAN_SET_MAIN_ORDER';
    }

    public function up(Schema $schema): void
    {
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Exception
     */
    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery("INSERT INTO `permission` (`last_user_id`, `label`, `code`) VALUE (1, 'Установка основного заказа для доп. комплектующих', 'ROLE_CAN_SET_MAIN_ORDER')");
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
        $this->connection->executeQuery("DELETE FROM `permission` WHERE `code` = 'ROLE_CAN_SET_MAIN_ORDER'");
    }
}
