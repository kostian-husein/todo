<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210225093004 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('order_item'))
        {
            $table = $schema->getTable('order_item');

            if ( ! $table->hasColumn('external_id')) {
                $table->addColumn('external_id', 'string', ['length' => 255, 'notnull' => false]);
            }
        }

        if ($schema->hasTable('order_status'))
        {
            $table = $schema->getTable('order_status');

            if ( ! $table->hasColumn('external_id')) {
                $table->addColumn('external_id', 'string', ['length' => 255, 'notnull' => false]);
            }
        }
    }

    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery('INSERT INTO order_status (last_user_id, label, external_id) VALUES (43, "В очереди", "edafb0d3-e949-45ed-a238-5caec95b2273")');
        $this->connection->executeQuery('INSERT INTO order_status (last_user_id, label, external_id) VALUES (43, "В разработке", "a83bb66e-5d4f-4c4f-b2a9-62050910b1d5")');
        $this->connection->executeQuery('INSERT INTO order_status (last_user_id, label, external_id) VALUES (43, "Готов", "12af0ef5-5ea1-4dbb-9ac8-6986a76fe22a")');
        $this->connection->executeQuery('INSERT INTO order_status (last_user_id, label, external_id) VALUES (43, "Заготовлен", "4520d8cb-060d-48cc-a0b5-494ae611d90c")');
        $this->connection->executeQuery('INSERT INTO order_status (last_user_id, label, external_id) VALUES (43, "Мониторинг заказов", "afd3adc9-f3c5-44d6-baa3-6b80dce17c36")');
        $this->connection->executeQuery('INSERT INTO order_status (last_user_id, label, external_id) VALUES (43, "На проверке", "13e1299e-f5c7-4819-8279-5f8875f00608")');
        $this->connection->executeQuery('INSERT INTO order_status (last_user_id, label, external_id) VALUES (43, "На согласовании", "6578f928-a6ff-48d4-b3be-709a6f371bcf")');
        $this->connection->executeQuery('INSERT INTO order_status (last_user_id, label, external_id) VALUES (43, "Окрашен", "1575e633-e6b6-4633-87a1-9443516fe33e")');
        $this->connection->executeQuery('INSERT INTO order_status (last_user_id, label, external_id) VALUES (43, "Отгружен", "77b66a0d-ef74-42d5-ba44-e15adc219b41")');
        $this->connection->executeQuery('INSERT INTO order_status (last_user_id, label, external_id) VALUES (43, "Отклонен", "3014d3fb-f400-486b-b8d9-859d53be65d8")');
        $this->connection->executeQuery('INSERT INTO order_status (last_user_id, label, external_id) VALUES (43, "Поступил", "20a93121-df38-4a64-96a6-9b9586d753bc")');
        $this->connection->executeQuery('INSERT INTO order_status (last_user_id, label, external_id) VALUES (43, "Сварен", "68609025-e77f-4e52-ba6d-e4db351cdd06")');
        $this->connection->executeQuery('INSERT INTO order_status (last_user_id, label, external_id) VALUES (43, "Согласован", "4090f6dd-31d8-4c99-844b-a7019b8d3771")');
        $this->connection->executeQuery('INSERT INTO order_status (last_user_id, label, external_id) VALUES (43, "Ушел в сборку", "6dfc935d-e4a7-43c1-8393-8072ce3da852")');

        $this->connection->executeQuery('UPDATE order_status SET external_id = "dddb2c92-854b-41eb-8e86-8dbd26f9dc1e" WHERE label = "В работе"');
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('order_item'))
        {
            $table = $schema->getTable('order_item');

            if ($table->hasColumn('external_id')) {
                $table->dropColumn('external_id');
            }
        }

        if ($schema->hasTable('order_status'))
        {
            $table = $schema->getTable('order_status');

            if ($table->hasColumn('external_id')) {
                $table->dropColumn('external_id');
            }
        }
    }
}
