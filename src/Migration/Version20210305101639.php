<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210305101639 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('order_status')) {
            $table = $schema->getTable('order_status');

            if ( ! $table->hasColumn('system_status')) {
                $table->addColumn('system_status', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            }
        }
    }

    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery('INSERT INTO order_status (last_user_id, label, system_status) VALUES (43, "Замер", 1)');
        $this->connection->executeQuery('INSERT INTO order_status (last_user_id, label, system_status) VALUES (43, "На согласовании", 1)');

        $this->connection->executeQuery('UPDATE order_status SET system_status = 1 WHERE label = "Заготовка"');
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('order_status')) {
            $table = $schema->getTable('order_status');

            if ($table->hasColumn('system_status')) {
                $table->dropColumn('system_status');
            }
        }

    }
}
