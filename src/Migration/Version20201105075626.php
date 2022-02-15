<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201105075626 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
    }

    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery('SET FOREIGN_KEY_CHECKS = 0;');
        $this->connection->executeQuery('TRUNCATE TABLE user_role;');
        $this->connection->executeQuery('TRUNCATE TABLE user_permission;');
        $this->connection->executeQuery('TRUNCATE TABLE role_permission;');
        $this->connection->executeQuery('TRUNCATE TABLE role;');
        $this->connection->executeQuery('TRUNCATE TABLE permission;');

        $this->connection->executeQuery("INSERT INTO role (role_id, last_user_id, label) VALUES (1, 1, 'Разработчик')");
        $this->connection->executeQuery("INSERT INTO role (role_id, last_user_id, label) VALUES (2, 1, 'Админ')");
        $this->connection->executeQuery("INSERT INTO role (role_id, last_user_id, label) VALUES (3, 1, 'Дистрибьютор')");
        $this->connection->executeQuery("INSERT INTO role (role_id, last_user_id, label) VALUES (4, 1, 'Дилер')");
        $this->connection->executeQuery("INSERT INTO role (role_id, last_user_id, label) VALUES (5, 1, 'Менеджер')");

        $this->connection->executeQuery("INSERT INTO permission (permission_id, last_user_id, label, code) VALUES (1, 1, 'Может видеть цену завода', 'ROLE_CAN_SEE_PLANT_PRICE')");
        $this->connection->executeQuery("INSERT INTO permission (permission_id, last_user_id, label, code) VALUES (2, 1, 'Может видеть оптовую цену', 'ROLE_CAN_SEE_OPT_PRICE')");
        $this->connection->executeQuery("INSERT INTO permission (permission_id, last_user_id, label, code) VALUES (3, 1, 'Может пользоваться калькулятором', 'ROLE_CAN_USE_CALCULATOR')");
        $this->connection->executeQuery("INSERT INTO permission (permission_id, last_user_id, label, code) VALUES (4, 1, 'Может пользоваться системой ВДС', 'ROLE_CAN_USE_VDS')");
        $this->connection->executeQuery("INSERT INTO permission (permission_id, last_user_id, label, code) VALUES (5, 1, 'Может создавать/изменять сущности', 'ROLE_CAN_EDIT_ENTITIES')");
        $this->connection->executeQuery("INSERT INTO permission (permission_id, last_user_id, label, code) VALUES (6, 1, 'Может удалять/востаналивать сущности', 'ROLE_CAN_DELETE_ENTITIES')");
        $this->connection->executeQuery("INSERT INTO permission (permission_id, last_user_id, label, code) VALUES (7, 1, 'Разработчик', 'ROLE_THE_GOD')");
        $this->connection->executeQuery("INSERT INTO permission (permission_id, last_user_id, label, code) VALUES (8, 1, 'Пользователь', 'ROLE_USER')");

        $this->connection->executeQuery("INSERT INTO role_permission (role_id, permission_id) VALUES (1, 1)");
        $this->connection->executeQuery("INSERT INTO role_permission (role_id, permission_id) VALUES (1, 2)");
        $this->connection->executeQuery("INSERT INTO role_permission (role_id, permission_id) VALUES (1, 3)");
        $this->connection->executeQuery("INSERT INTO role_permission (role_id, permission_id) VALUES (1, 4)");
        $this->connection->executeQuery("INSERT INTO role_permission (role_id, permission_id) VALUES (1, 5)");
        $this->connection->executeQuery("INSERT INTO role_permission (role_id, permission_id) VALUES (1, 6)");
        $this->connection->executeQuery("INSERT INTO role_permission (role_id, permission_id) VALUES (1, 7)");
        $this->connection->executeQuery("INSERT INTO role_permission (role_id, permission_id) VALUES (1, 8)");

        $this->connection->executeQuery("INSERT INTO role_permission (role_id, permission_id) VALUES (2, 2)");
        $this->connection->executeQuery("INSERT INTO role_permission (role_id, permission_id) VALUES (2, 3)");
        $this->connection->executeQuery("INSERT INTO role_permission (role_id, permission_id) VALUES (2, 4)");
        $this->connection->executeQuery("INSERT INTO role_permission (role_id, permission_id) VALUES (2, 5)");
        $this->connection->executeQuery("INSERT INTO role_permission (role_id, permission_id) VALUES (2, 6)");
        $this->connection->executeQuery("INSERT INTO role_permission (role_id, permission_id) VALUES (2, 7)");
        $this->connection->executeQuery("INSERT INTO role_permission (role_id, permission_id) VALUES (2, 8)");

        $this->connection->executeQuery("INSERT INTO user_role (user_id, role_id) VALUES ((SELECT user_id FROM user WHERE login = 'zhuralex172'), 1)");
        $this->connection->executeQuery("INSERT INTO user_role (user_id, role_id) VALUES ((SELECT user_id FROM user WHERE login = 'denis'), 1)");
        $this->connection->executeQuery('SET FOREIGN_KEY_CHECKS = 1;');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
