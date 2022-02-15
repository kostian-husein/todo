<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210722080446 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        if ($schema->hasTable('client_order')) {
            $table = $schema->getTable('client_order');

            $table->dropColumn('label');
        }

        if ($schema->hasTable('order_item')) {
            $table = $schema->getTable('order_item');

            $table->addColumn('code', 'string', ['notnull' => false, 'length' => 50]);
            $table->addUniqueIndex(['code'], 'code');

            $table->dropColumn('quantity');
        }
    }

    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery("DELETE FROM order_item WHERE item_id=53");
        $this->connection->executeQuery("UPDATE `order_item` t1, (SELECT order_id, code FROM `client_order`) t2 SET t1.code = t2.code WHERE t2.order_id = t1.order_id");
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('client_order')) {
            $table = $schema->getTable('client_order');

            $table->addColumn('label', 'string', ['notnull' => false, 'length' => 255]);
        }

        if ($schema->hasTable('order_item')) {
            $table = $schema->getTable('order_item');

            //$table->dropIndex('code');
            $table->dropColumn('code');

            $table->addColumn('quantity', 'integer', ['unsigned' => true, 'notnull' => true, 'default' => 1]);
        }
    }
}
