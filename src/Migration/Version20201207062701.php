<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201207062701 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        if ( ! $schema->hasTable('order_item_service')) {
            $table = $schema->createTable('order_item_service');

            $table->addColumn('id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('item_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('service_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => true]);

            $table->setPrimaryKey(['id']);

            $table->addIndex(['is_active'], 'is_active');
            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['last_user_id'], 'last_user_id');
            $table->addIndex(['item_id'], 'item_id');
            $table->addIndex(['service_id'], 'service_id');

            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения услуг для товаров');

            $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_LAST_USER_ITEM_SERVICE');
            $table->addForeignKeyConstraint('order_item', ['item_id'], ['item_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_ITEM_ITEM_SERVICE');
            $table->addForeignKeyConstraint('service', ['service_id'], ['service_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_SERVICE_ITEM_SERVICE');
        }

        if ($schema->hasTable('service_price')) {
            $table = $schema->getTable('service_price');

            if ($table->hasColumn('city_id')) {
                $table->getColumn('city_id')->setNotnull(false);
            }

            if ($table->hasColumn('region_id')) {
                $table->getColumn('region_id')->setNotnull(false);
            }
        }
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('order_item_service')) {
            $table = $schema->getTable('order_item_service');

            foreach ($table->getForeignKeys() as $foreignKey) {
                if ($table->hasForeignKey($foreignKey->getName())){
                    $table->removeForeignKey($foreignKey->getName());
                }
            }
            $schema->dropTable($table->getName());
        }
    }
}
