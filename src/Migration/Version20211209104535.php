<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211209104535 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add new role_permissions';
    }

    public function up(Schema $schema): void
    {
        if ($schema->hasTable('user')) {
            $table = $schema->getTable('user');

            if (!$table->hasColumn('is_dealer')) {
                $table->addColumn('is_dealer', 'boolean', ['unsigned' => true, 'notnull' => false, 'default' => 0]);
                $table->addIndex(['is_dealer'], 'is_dealer');
            }
        }

        if ($schema->hasTable('client_order')) {
            $table = $schema->getTable('client_order');
            if ($table->hasColumn('bitrix_number')) {
                $table->dropColumn('bitrix_number');
            }
        }
    }

    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery("INSERT INTO `permission` (`permission_id`, `last_user_id`, `label`, `code`) VALUE (20, 1, 'Может видеть клиента как соисполнитель', 'ROLE_CAN_SEE_CLIENT_AS_CO_EXECUTOR')"); // колл-менеджер + замерщик + установщик (видят если являются соисполнителями любого заказа)
        $this->connection->executeQuery("INSERT INTO `permission` (`permission_id`, `last_user_id`, `label`, `code`) VALUE (21, 1, 'Не видит клиентскую информацию', 'ROLE_CAN_NOT_SEE_CLIENT_INFO')"); // можно поставить тому, кому нельзя видеть инфу по клиентам вообще

        $this->connection->executeQuery("INSERT INTO `role_permission` (`role_id`, `permission_id`) VALUES (6, 20), (8, 20), (9, 20)");
        $this->connection->executeQuery("INSERT INTO `role_permission` (`role_id`, `permission_id`) VALUES (2, 21)");

        $this->connection->executeQuery("UPDATE user u
                                                JOIN user_role r ON u.user_id = r.user_id AND r.role_id IN (6, 8, 9)
                                                SET u.roles = JSON_ARRAY_APPEND(u.roles, '$', 'ROLE_CAN_SEE_CLIENT_AS_CO_EXECUTOR');");
        $this->connection->executeQuery("UPDATE user u
                                                JOIN user_role r ON u.user_id = r.user_id AND r.role_id IN (2)
                                                SET u.roles = JSON_ARRAY_APPEND(u.roles, '$', 'ROLE_CAN_NOT_SEE_CLIENT_INFO');");
        $this->connection->executeQuery("UPDATE user u JOIN user_role ur ON u.user_id = ur.user_id AND ur.role_id = 4 SET u.is_dealer = 1;");
        $this->connection->executeQuery("UPDATE user u JOIN user_role ur ON u.user_id = ur.user_id AND ur.role_id = 4 SET u.is_distributor = 0;");
        $this->connection->executeQuery("UPDATE user u JOIN user_role ur ON u.user_id = ur.user_id AND ur.role_id = 3 SET u.is_distributor = 1;");
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('client_order')) {
            $table = $schema->getTable('client_order');

            if (!$table->hasColumn('bitrix_number')) {
                $table->addColumn('bitrix_number', 'integer', ['unsigned' => true, 'notnull' => false]);
            }
        }

        if ($schema->hasTable('user')) {
            $table = $schema->getTable('user');

            if ($table->hasColumn('is_dealer')) {
                $table->dropColumn('is_dealer');
            }
        }
    }

    public function postDown(Schema $schema): void
    {
        $this->connection->executeQuery("DELETE FROM `role_permission` WHERE `permission_id` = 20");
        $this->connection->executeQuery("DELETE FROM `role_permission` WHERE `permission_id` = 21");

        $this->connection->executeQuery("DELETE FROM `permission` WHERE `code` = 'ROLE_CAN_SEE_CLIENT_AS_CO_EXECUTOR'");
        $this->connection->executeQuery("DELETE FROM `permission` WHERE `code` = 'ROLE_CAN_NOT_SEE_CLIENT_INFO'");
    }
}
