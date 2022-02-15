<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210526121350 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        if (! $schema->hasTable('co_executor')) {
            $table = $schema->createTable('co_executor');

            $table->addColumn('id', 'integer', ['autoincrement' => true, 'unsigned' => true, 'notnull' => true]);
            $table->addColumn('user_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('order_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);

            $table->addIndex(['user_id'], 'user_id');
            $table->addIndex(['order_id'], 'order_id');

            $table->addUniqueIndex(['id'], 'id');
            $table->setPrimaryKey(['id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения соисполнителей для заказа');

            $table->addForeignKeyConstraint('user', ['user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_CO_EXECUTOR_USER');
            $table->addForeignKeyConstraint('client_order', ['order_id'], ['order_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_CO_EXECUTOR_ORDER');
        }
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('co_executor')) {
            $table = $schema->getTable('co_executor');

            if ($table->hasForeignKey('FK_CO_EXECUTOR_USER')) {
                $table->addForeignKeyConstraint('user', ['user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_CO_EXECUTOR_USER');
            }
            if ($table->hasForeignKey('FK_CO_EXECUTOR_ORDER')) {
                $table->addForeignKeyConstraint('order', ['order_id'], ['order_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_CO_EXECUTOR_ORDER');
            }

            $schema->dropTable('co_executor');
        }
    }
}
