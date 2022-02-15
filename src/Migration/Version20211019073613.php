<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211019073613 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        if (! $schema->hasTable('user_column_settings')) {
            $table = $schema->createTable('user_column_settings');

            $table->addColumn('setting_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('column_setting', 'json', ['notnull' => true]);
            $table->addColumn('user_id', 'integer', ['unsigned' => true, 'notnull' => false]);
            $table->addColumn('entity_name', 'string', ['notnull' => true, 'length' => 255]);

            $table->setPrimaryKey(['setting_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения пользовательских настроек колонок в таблицах');

            $table->addIndex(['user_id'], 'user_id');

            $table->addForeignKeyConstraint('user', ['user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_COLUMN_SETTINGS_USER');
        }
    }

    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery("INSERT INTO permission (last_user_id, label, code) VALUES (43, 'Может устанавливать колонки по умолчанию', 'ROLE_CAN_MANAGE_COLUMN_FOR_ALL')");
        $this->connection->executeQuery("INSERT into role_permission (role_id, permission_id) VALUES (1, 18), (2, 18);");
        $this->connection->executeQuery("UPDATE user u
            JOIN user_role r ON u.user_id = r.user_id AND r.role_id IN (1, 2)
            SET u.roles = JSON_ARRAY_APPEND(u.roles, '$', 'ROLE_CAN_MANAGE_COLUMN_FOR_ALL');
            ");
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('user_column_settings')) {
            $schema->dropTable('user_column_settings');
        }
    }
}
