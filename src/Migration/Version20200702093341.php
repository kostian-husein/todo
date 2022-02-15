<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Class Version20200702093341
 * @package Application\Migration
 */
final class Version20200702093341 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        if (!$schema->hasTable('payment_status')) {
            $table = $schema->createTable('payment_status');

            $table->addColumn('status_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('label', 'string', ['notnull' => true, 'length' => 20]);
            $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => true]);

            $table->setPrimaryKey(['status_id']);

            $table->addIndex(['is_active'], 'is_active');
            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['last_user_id'], 'last_user_id');

            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения статусов оплаты');

            $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_LAST_USER_PAYMENT_STATUS');
        }

        if (!$schema->hasTable('payment_type')) {
            $table = $schema->createTable('payment_type');

            $table->addColumn('payment_type_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('label', 'string', ['notnull' => true, 'length' => 50]);
            $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => true]);

            $table->setPrimaryKey(['payment_type_id']);
            $table->addUniqueIndex(['label']);

            $table->addIndex(['is_active'], 'is_active');
            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['last_user_id'], 'last_user_id');

            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения типов оплаты');

            $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_LAST_USER_PAYMENT_TYPE');
        }

        if (!$schema->hasTable('order_status')) {
            $table = $schema->createTable('order_status');

            $table->addColumn('status_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('label', 'string', ['notnull' => true, 'length' => 20]);
            $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => true]);

            $table->setPrimaryKey(['status_id']);

            $table->addIndex(['is_active'], 'is_active');
            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['last_user_id'], 'last_user_id');

            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения статусов заказа');

            $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_LAST_USER_ORDER_STATUS');
        }

        if (!$schema->hasTable('order_source')) {
            $table = $schema->createTable('order_source');

            $table->addColumn('source_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('label', 'string', ['notnull' => true, 'length' => 20]);
            $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => true]);

            $table->setPrimaryKey(['source_id']);

            $table->addIndex(['is_active'], 'is_active');
            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['last_user_id'], 'last_user_id');

            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения источников заказов');

            $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_LAST_USER_ORDER_SOURCE');
        }

        if (!$schema->hasTable('order_item')) {
            $table = $schema->createTable('order_item');

            $table->addColumn('item_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('label', 'string', ['notnull' => true, 'length' => 255]);
            $table->addColumn('order_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('type', 'string', ['notnull' => true]);
            $table->addColumn('price', 'decimal', ['unsigned' => true, 'notnull' => true, 'precision' => 20, 'scale' => 2]);
            $table->addColumn('discount_percent', 'decimal', ['unsigned' => true, 'notnull' => false, 'precision' => 20, 'scale' => 2, 'default' => null]);
            $table->addColumn('quantity', 'integer', ['unsigned' => true, 'notnull' => true, 'default' => 1]);
            $table->addColumn('data', 'json', ['notnull' => true]);
            $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => true]);

            $table->setPrimaryKey(['item_id']);

            $table->addIndex(['is_active'], 'is_active');
            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['last_user_id'], 'last_user_id');
            $table->addIndex(['order_id'], 'order_id');

            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения элементов заказов');

            $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_LAST_USER_ORDER_ITEM');
            $table->addForeignKeyConstraint('client_order', ['order_id'], ['order_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_ORDER_ITEM');
        }

        if ($schema->hasTable('client')) {
            $table = $schema->getTable('client');

            $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);

            $table->addIndex(['is_active'], 'is_active');
            $table->addIndex(['is_deleted'], 'is_deleted');
        }

        if (!$schema->hasTable('client_order')) {
            $table = $schema->createTable('client_order');

            $table->addColumn('order_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('label', 'string', ['notnull' => true, 'length' => 255]);
            $table->addColumn('code', 'string', ['notnull' => true, 'length' => 50]);
            $table->addColumn('external_id', 'string', ['notnull' => false, 'length' => 50]);
            $table->addColumn('client_id', 'integer', ['unsigned' => true, 'notnull' => false]);
            $table->addColumn('status_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('payment_status_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('price', 'decimal', ['unsigned' => true, 'notnull' => true, 'precision' => 20, 'scale' => 2, 'default' => 0]);
            $table->addColumn('created_by_user_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('responsible_user_id', 'integer', ['unsigned' => true, 'notnull' => false]);
            $table->addColumn('money_paid', 'decimal', ['unsigned' => true, 'notnull' => true, 'precision' => 20, 'scale' => 2, 'default' => 0]);
            $table->addColumn('source_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('shipment_date', 'datetime', ['notnull' => true]);
            $table->addColumn('store_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            $table->addColumn('is_locked', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            $table->addColumn('is_standard', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('last_view_user_id', 'integer', ['unsigned' => true, 'notnull' => true]);

            $table->setPrimaryKey(['order_id']);

            $table->addUniqueIndex(['code'], 'code');
            $table->addUniqueIndex(['external_id'], 'external_id');

            $table->addIndex(['client_id'], 'client_id');
            $table->addIndex(['payment_status_id'], 'payment_status_id');
            $table->addIndex(['status_id'], 'status_id');
            $table->addIndex(['created_by_user_id'], 'created_by_user_id');
            $table->addIndex(['responsible_user_id'], 'responsible_user_id');
            $table->addIndex(['source_id'], 'source_id');
            $table->addIndex(['store_id'], 'store_id');
            $table->addIndex(['is_active'], 'is_active');
            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['last_user_id'], 'last_user_id');
            $table->addIndex(['last_view_user_id'], 'last_view_user_id');

            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения заказов');

            $table->addForeignKeyConstraint('client', ['client_id'], ['client_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_CLIENT_ORDER');
            $table->addForeignKeyConstraint('user', ['created_by_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_CREATED_BY_USER_ORDER');
            $table->addForeignKeyConstraint('user', ['responsible_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_RESPONSIBLE_USER_ORDER');
            $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_LAST_USER_ORDER');
            $table->addForeignKeyConstraint('user', ['last_view_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_LAST_VIEW_USER_ORDER');
            $table->addForeignKeyConstraint('order_status', ['status_id'], ['status_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_STATUS_ORDER');
            $table->addForeignKeyConstraint('order_source', ['source_id'], ['source_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_SOURCE_ORDER');
            $table->addForeignKeyConstraint('store', ['store_id'], ['store_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_STORE_ORDER');
            $table->addForeignKeyConstraint('payment_status', ['payment_status_id'], ['status_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_PAYMENT_STATUS_ORDER');
        }

        if (!$schema->hasTable('service')) {
            $table = $schema->createTable('service');

            $table->addColumn('service_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('label', 'string', ['notnull' => true, 'length' => 50]);
            $table->addColumn('description', 'text', ['notnull' => false, 'default' => null]);
            $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => true]);

            $table->setPrimaryKey(['service_id']);

            $table->addIndex(['is_active'], 'is_active');
            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['last_user_id'], 'last_user_id');

            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения услуг');

            $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_LAST_USER_SERVICE');
        }

        if (!$schema->hasTable('service_price')) {
            $table = $schema->createTable('service_price');

            $table->addColumn('service_price_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('service_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('price', 'decimal', ['unsigned' => true, 'notnull' => true, 'precision' => 20, 'scale' => 2, 'default' => 0]);
            $table->addColumn('city_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('country_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('region_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => true]);

            $table->setPrimaryKey(['service_price_id']);

            $table->addIndex(['service_id'], 'service_id');
            $table->addIndex(['city_id'], 'city_id');
            $table->addIndex(['country_id'], 'country_id');
            $table->addIndex(['region_id'], 'region_id');
            $table->addIndex(['is_active'], 'is_active');
            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['last_user_id'], 'last_user_id');

            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения цен на услуги');

            $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_LAST_USER_SERVICE_PRICE');
            $table->addForeignKeyConstraint('city', ['city_id'], ['city_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_CITY_SERVICE_PRICE');
            $table->addForeignKeyConstraint('region', ['region_id'], ['region_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_REGION_SERVICE_PRICE');
            $table->addForeignKeyConstraint('country', ['country_id'], ['country_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_COUNTRY_SERVICE_PRICE');
            $table->addForeignKeyConstraint('service', ['service_id'], ['service_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_SERVICE_SERVICE_PRICE');
        }

        if (!$schema->hasTable('order_service')) {
            $table = $schema->createTable('order_service');

            $table->addColumn('id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('order_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('service_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('service_price_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => true]);

            $table->setPrimaryKey(['id']);

            $table->addIndex(['is_active'], 'is_active');
            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['last_user_id'], 'last_user_id');
            $table->addIndex(['order_id'], 'order_id');
            $table->addIndex(['service_id'], 'service_id');
            $table->addIndex(['service_price_id'], 'service_price_id');

            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения услуг заказов');

            $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_LAST_USER_ORDER_SERVICE');
            $table->addForeignKeyConstraint('client_order', ['order_id'], ['order_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_ORDER_ORDER_SERVICE');
            $table->addForeignKeyConstraint('service', ['service_id'], ['service_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_SERVICE_ORDER_SERVICE');
            $table->addForeignKeyConstraint('service_price', ['service_price_id'], ['service_price_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_SERVICE_PRICE_ORDER_SERVICE');
        }

        if (!$schema->hasTable('order_comment')) {
            $table = $schema->createTable('order_comment');

            $table->addColumn('comment_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('order_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('user_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('comment', 'text', ['notnull' => true]);
            $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);

            $table->setPrimaryKey(['comment_id']);

            $table->addIndex(['is_active'], 'is_active');
            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['user_id'], 'user_id');
            $table->addIndex(['order_id'], 'order_id');

            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения комментариев к заказам');

            $table->addForeignKeyConstraint('user', ['user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_ORDER_COMMENT');
            $table->addForeignKeyConstraint('client_order', ['order_id'], ['order_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_ORDER_ORDER_COMMENT');
        }

        if (!$schema->hasTable('order_item_comment')) {
            $table = $schema->createTable('order_item_comment');

            $table->addColumn('comment_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('item_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('user_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('comment', 'text', ['notnull' => true]);
            $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);

            $table->setPrimaryKey(['comment_id']);

            $table->addIndex(['is_active'], 'is_active');
            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['user_id'], 'user_id');
            $table->addIndex(['item_id'], 'item_id');

            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения комментариев к элементам заказов');

            $table->addForeignKeyConstraint('user', ['user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_ORDER_ITEM_COMMENT');
            $table->addForeignKeyConstraint('order_item', ['item_id'], ['item_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_ORDER_ITEM_COMMENT');
        }

        if (!$schema->hasTable('order_service_comment')) {
            $table = $schema->createTable('order_service_comment');

            $table->addColumn('comment_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('order_service_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('user_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('comment', 'text', ['notnull' => true]);
            $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);

            $table->setPrimaryKey(['comment_id']);

            $table->addIndex(['is_active'], 'is_active');
            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['user_id'], 'user_id');
            $table->addIndex(['order_service_id'], 'order_service_id');

            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения комментариев к услугам заказов');

            $table->addForeignKeyConstraint('user', ['user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_ORDER_SERVICE_COMMENT');
            $table->addForeignKeyConstraint('order_service', ['order_service_id'], ['id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_ORDER_SERVICE_COMMENT');
        }

        if (!$schema->hasTable('order_history')) {
            $table = $schema->createTable('order_history');

            $table->addColumn('history_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('order_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('user_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('changed_data', 'json', ['notnull' => true]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);

            $table->setPrimaryKey(['history_id']);

            $table->addIndex(['user_id'], 'user_id');
            $table->addIndex(['order_id'], 'order_id');

            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения изменений заказов');

            $table->addForeignKeyConstraint('user', ['user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_ORDER_HISTORY');
            $table->addForeignKeyConstraint('client_order', ['order_id'], ['order_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_ORDER_HISTORY');
        }

        if (!$schema->hasTable('order_change_request')) {
            $table = $schema->createTable('order_change_request');

            $table->addColumn('request_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('order_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('user_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('status', 'string', ['notnull' => true]);
            $table->addColumn('comment', 'text', ['notnull' => true]);
            $table->addColumn('response', 'text', ['notnull' => false]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => true]);

            $table->setPrimaryKey(['request_id']);

            $table->addIndex(['user_id'], 'user_id');
            $table->addIndex(['order_id'], 'order_id');
            $table->addIndex(['last_user_id'], 'last_user_id');
            $table->addIndex(['is_active'], 'is_active');
            $table->addIndex(['is_deleted'], 'is_deleted');

            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения запросов на изменение заказа');

            $table->addForeignKeyConstraint('user', ['user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_ORDER_CHANGE_REQUEST');
            $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_LAST_USER_ORDER_CHANGE_REQUEST');
            $table->addForeignKeyConstraint('client_order', ['order_id'], ['order_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_ORDER_CHANGE_REQUEST');
        }

        if (!$schema->hasTable('cancellation_reason')) {
            $table = $schema->createTable('cancellation_reason');

            $table->addColumn('reason_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('label', 'string', ['notnull' => true, 'length' => 50]);
            $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => true]);

            $table->setPrimaryKey(['reason_id']);

            $table->addIndex(['is_active'], 'is_active');
            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['last_user_id'], 'last_user_id');

            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения причин отмены');

            $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_LAST_USER_CANCELLATION_REASON');
        }

        if (!$schema->hasTable('order_cancellation')) {
            $table = $schema->createTable('order_cancellation');

            $table->addColumn('cancellation_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('order_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('user_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('reason_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('comment', 'text', ['notnull' => true]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);

            $table->setPrimaryKey(['cancellation_id']);

            $table->addIndex(['is_active'], 'is_active');
            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['user_id'], 'user_id');
            $table->addIndex(['reason_id'], 'reason_id');
            $table->addIndex(['order_id'], 'order_id');

            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения отмененных заказов');

            $table->addForeignKeyConstraint('user', ['user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_ORDER_CANCELLATION');
            $table->addForeignKeyConstraint('client_order', ['order_id'], ['order_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_ORDER_CANCELLATION');
            $table->addForeignKeyConstraint('cancellation_reason', ['reason_id'], ['reason_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_ORDER_CANCELLATION_REASON');
        }

        if ($schema->hasTable('store_contact')) {
            $table = $schema->getTable('store_contact');

            if (!$table->hasColumn('is_active')) {
                $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);
                $table->addIndex(['is_active'], 'is_active');
            }
        }
    }

    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery("INSERT INTO order_status (label, last_user_id) VALUES ('В обработке', (SELECT user_id FROM user WHERE first_name = 'Завод'))");
        $this->connection->executeQuery("INSERT INTO order_status (label, last_user_id) VALUES ('Передан', (SELECT user_id FROM user WHERE first_name = 'Завод'))");
        $this->connection->executeQuery("INSERT INTO order_status (label, last_user_id) VALUES ('В ожидании', (SELECT user_id FROM user WHERE first_name = 'Завод'))");
        $this->connection->executeQuery("INSERT INTO order_status (label, last_user_id) VALUES ('Присвоен', (SELECT user_id FROM user WHERE first_name = 'Завод'))");
        $this->connection->executeQuery("INSERT INTO order_status (label, last_user_id) VALUES ('В работе', (SELECT user_id FROM user WHERE first_name = 'Завод'))");
        $this->connection->executeQuery("INSERT INTO order_status (label, last_user_id) VALUES ('Выполнен', (SELECT user_id FROM user WHERE first_name = 'Завод'))");
        $this->connection->executeQuery("INSERT INTO order_status (label, last_user_id) VALUES ('Запрошено изменение', (SELECT user_id FROM user WHERE first_name = 'Завод'))");
        $this->connection->executeQuery("INSERT INTO order_status (label, last_user_id) VALUES ('Изменение', (SELECT user_id FROM user WHERE first_name = 'Завод'))");
        $this->connection->executeQuery("INSERT INTO order_status (label, last_user_id) VALUES ('Изменен', (SELECT user_id FROM user WHERE first_name = 'Завод'))");
        $this->connection->executeQuery("INSERT INTO order_status (label, last_user_id) VALUES ('Отменен', (SELECT user_id FROM user WHERE first_name = 'Завод'))");
        $this->connection->executeQuery("INSERT INTO order_status (label, last_user_id) VALUES ('Завершен', (SELECT user_id FROM user WHERE first_name = 'Завод'))");
        $this->connection->executeQuery("INSERT INTO order_status (label, last_user_id) VALUES ('Заготовка', (SELECT user_id FROM user WHERE first_name = 'Завод'))");
        $this->connection->executeQuery("INSERT INTO order_status (label, last_user_id) VALUES ('Рекламация', (SELECT user_id FROM user WHERE first_name = 'Завод'))");

        $this->connection->executeQuery("INSERT INTO payment_type (label, last_user_id) VALUES ('Наличный', (SELECT user_id FROM user WHERE first_name = 'Завод'))");
        $this->connection->executeQuery("INSERT INTO payment_type (label, last_user_id) VALUES ('Безналичный', (SELECT user_id FROM user WHERE first_name = 'Завод'))");

        $this->connection->executeQuery("INSERT INTO payment_status (label, last_user_id) VALUES ('Внесена предоплата', (SELECT user_id FROM user WHERE first_name = 'Завод'))");
        $this->connection->executeQuery("INSERT INTO payment_status (label, last_user_id) VALUES ('Полностью оплачен', (SELECT user_id FROM user WHERE first_name = 'Завод'))");
        $this->connection->executeQuery("INSERT INTO payment_status (label, last_user_id) VALUES ('Не оплачен', (SELECT user_id FROM user WHERE first_name = 'Завод'))");

        $this->connection->executeQuery("ALTER TABLE `order_item` MODIFY `type` ENUM('configured', 'marker') NOT NULL DEFAULT 'configured';");
        $this->connection->executeQuery("ALTER TABLE `order_change_request` MODIFY `status` ENUM('waiting', 'rejected', 'approved', 'cancelled') NOT NULL DEFAULT 'waiting';");
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('order_cancellation')) {
            $table = $schema->getTable('order_cancellation');

            if ($table->hasForeignKey('FK_USER_ORDER_CANCELLATION')) {
                $table->removeForeignKey('FK_USER_ORDER_CANCELLATION');
            }

            if ($table->hasForeignKey('FK_ORDER_CANCELLATION')) {
                $table->removeForeignKey('FK_ORDER_CANCELLATION');
            }

            if ($table->hasForeignKey('FK_ORDER_CANCELLATION_REASON')) {
                $table->removeForeignKey('FK_ORDER_CANCELLATION_REASON');
            }

            $schema->dropTable('order_cancellation');
        }

        if ($schema->hasTable('cancellation_reason')) {
            $table = $schema->getTable('cancellation_reason');

            if ($table->hasForeignKey('FK_LAST_USER_CANCELLATION_REASON')) {
                $table->removeForeignKey('FK_LAST_USER_CANCELLATION_REASON');
            }

            $schema->dropTable('cancellation_reason');
        }

        if ($schema->hasTable('order_change_request')) {
            $table = $schema->getTable('order_change_request');

            if ($table->hasForeignKey('FK_USER_ORDER_CHANGE_REQUEST')) {
                $table->removeForeignKey('FK_USER_ORDER_CHANGE_REQUEST');
            }

            if ($table->hasForeignKey('FK_LAST_USER_ORDER_CHANGE_REQUEST')) {
                $table->removeForeignKey('FK_LAST_USER_ORDER_CHANGE_REQUEST');
            }

            if ($table->hasForeignKey('FK_ORDER_CHANGE_REQUEST')) {
                $table->removeForeignKey('FK_ORDER_CHANGE_REQUEST');
            }

            $schema->dropTable('order_change_request');
        }

        if ($schema->hasTable('order_history')) {
            $table = $schema->getTable('order_history');

            if ($table->hasForeignKey('FK_USER_ORDER_HISTORY')) {
                $table->removeForeignKey('FK_USER_ORDER_HISTORY');
            }

            if ($table->hasForeignKey('FK_ORDER_HISTORY')) {
                $table->removeForeignKey('FK_ORDER_HISTORY');
            }

            $schema->dropTable('order_history');
        }

        if ($schema->hasTable('order_service_comment')) {
            $table = $schema->getTable('order_service_comment');

            if ($table->hasForeignKey('FK_USER_ORDER_SERVICE_COMMENT')) {
                $table->removeForeignKey('FK_USER_ORDER_SERVICE_COMMENT');
            }

            if ($table->hasForeignKey('FK_ORDER_SERVICE_COMMENT')) {
                $table->removeForeignKey('FK_ORDER_SERVICE_COMMENT');
            }

            $schema->dropTable('order_service_comment');
        }

        if ($schema->hasTable('order_item_comment')) {
            $table = $schema->getTable('order_item_comment');

            if ($table->hasForeignKey('FK_USER_ORDER_ITEM_COMMENT')) {
                $table->removeForeignKey('FK_USER_ORDER_ITEM_COMMENT');
            }

            if ($table->hasForeignKey('FK_ORDER_ITEM_COMMENT')) {
                $table->removeForeignKey('FK_ORDER_ITEM_COMMENT');
            }

            $schema->dropTable('order_item_comment');
        }

        if ($schema->hasTable('order_comment')) {
            $table = $schema->getTable('order_comment');

            if ($table->hasForeignKey('FK_USER_ORDER_COMMENT')) {
                $table->removeForeignKey('FK_USER_ORDER_COMMENT');
            }

            if ($table->hasForeignKey('FK_ORDER_ORDER_COMMENT')) {
                $table->removeForeignKey('FK_ORDER_ORDER_COMMENT');
            }

            $schema->dropTable('order_comment');
        }

        if ($schema->hasTable('order_service')) {
            $table = $schema->getTable('order_service');

            if ($table->hasForeignKey('FK_LAST_USER_ORDER_SERVICE')) {
                $table->removeForeignKey('FK_LAST_USER_ORDER_SERVICE');
            }

            if ($table->hasForeignKey('FK_ORDER_ORDER_SERVICE')) {
                $table->removeForeignKey('FK_ORDER_ORDER_SERVICE');
            }

            if ($table->hasForeignKey('FK_SERVICE_ORDER_SERVICE')) {
                $table->removeForeignKey('FK_SERVICE_ORDER_SERVICE');
            }

            if ($table->hasForeignKey('FK_SERVICE_PRICE_ORDER_SERVICE')) {
                $table->removeForeignKey('FK_SERVICE_PRICE_ORDER_SERVICE');
            }

            $schema->dropTable('order_service');
        }

        if ($schema->hasTable('service_price')) {
            $table = $schema->getTable('service_price');

            if ($table->hasForeignKey('FK_LAST_USER_SERVICE_PRICE')) {
                $table->removeForeignKey('FK_LAST_USER_SERVICE_PRICE');
            }

            if ($table->hasForeignKey('FK_CITY_SERVICE_PRICE')) {
                $table->removeForeignKey('FK_CITY_SERVICE_PRICE');
            }

            if ($table->hasForeignKey('FK_REGION_SERVICE_PRICE')) {
                $table->removeForeignKey('FK_REGION_SERVICE_PRICE');
            }

            if ($table->hasForeignKey('FK_COUNTRY_SERVICE_PRICE')) {
                $table->removeForeignKey('FK_COUNTRY_SERVICE_PRICE');
            }

            if ($table->hasForeignKey('FK_SERVICE_SERVICE_PRICE')) {
                $table->removeForeignKey('FK_SERVICE_SERVICE_PRICE');
            }

            $schema->dropTable('service_price');
        }

        if ($schema->hasTable('service')) {
            $table = $schema->getTable('service');

            if ($table->hasForeignKey('FK_LAST_USER_SERVICE')) {
                $table->removeForeignKey('FK_LAST_USER_SERVICE');
            }

            $schema->dropTable('service');
        }

        if ($schema->hasTable('client_order')) {
            $table = $schema->getTable('client_order');

            if ($table->hasForeignKey('FK_CLIENT_ORDER')) {
                $table->removeForeignKey('FK_CLIENT_ORDER');
            }

            if ($table->hasForeignKey('FK_CREATED_BY_USER_ORDER')) {
                $table->removeForeignKey('FK_CREATED_BY_USER_ORDER');
            }

            if ($table->hasForeignKey('FK_RESPONSIBLE_USER_ORDER')) {
                $table->removeForeignKey('FK_RESPONSIBLE_USER_ORDER');
            }

            if ($table->hasForeignKey('FK_PAYMENT_STATUS_ORDER')) {
                $table->removeForeignKey('FK_PAYMENT_STATUS_ORDER');
            }

            if ($table->hasForeignKey('FK_LAST_USER_ORDER')) {
                $table->removeForeignKey('FK_LAST_USER_ORDER');
            }

            if ($table->hasForeignKey('FK_LAST_VIEW_USER_ORDER')) {
                $table->removeForeignKey('FK_LAST_VIEW_USER_ORDER');
            }

            if ($table->hasForeignKey('FK_STATUS_ORDER')) {
                $table->removeForeignKey('FK_STATUS_ORDER');
            }

            if ($table->hasForeignKey('FK_SOURCE_ORDER')) {
                $table->removeForeignKey('FK_SOURCE_ORDER');
            }

            if ($table->hasForeignKey('FK_STORE_ORDER')) {
                $table->removeForeignKey('FK_STORE_ORDER');
            }

            $schema->dropTable('client_order');
        }

        if ($schema->hasTable('order')) {
            $table = $schema->getTable('order');

            if ($table->hasForeignKey('FK_CLIENT_ORDER')) {
                $table->removeForeignKey('FK_CLIENT_ORDER');
            }

            if ($table->hasForeignKey('FK_CREATED_BY_USER_ORDER')) {
                $table->removeForeignKey('FK_CREATED_BY_USER_ORDER');
            }

            if ($table->hasForeignKey('FK_RESPONSIBLE_USER_ORDER')) {
                $table->removeForeignKey('FK_RESPONSIBLE_USER_ORDER');
            }

            if ($table->hasForeignKey('FK_PAYMENT_STATUS_ORDER')) {
                $table->removeForeignKey('FK_PAYMENT_STATUS_ORDER');
            }

            if ($table->hasForeignKey('FK_LAST_USER_ORDER')) {
                $table->removeForeignKey('FK_LAST_USER_ORDER');
            }

            if ($table->hasForeignKey('FK_LAST_VIEW_USER_ORDER')) {
                $table->removeForeignKey('FK_LAST_VIEW_USER_ORDER');
            }

            if ($table->hasForeignKey('FK_STATUS_ORDER')) {
                $table->removeForeignKey('FK_STATUS_ORDER');
            }

            if ($table->hasForeignKey('FK_SOURCE_ORDER')) {
                $table->removeForeignKey('FK_SOURCE_ORDER');
            }

            if ($table->hasForeignKey('FK_STORE_ORDER')) {
                $table->removeForeignKey('FK_STORE_ORDER');
            }

            $schema->dropTable('order');
        }

        if ($schema->hasTable('order_item')) {
            $table = $schema->getTable('order_item');

            if ($table->hasForeignKey('FK_LAST_USER_ORDER_ITEM')) {
                $table->removeForeignKey('FK_LAST_USER_ORDER_ITEM');
            }

            if ($table->hasForeignKey('FK_ORDER_ITEM')) {
                $table->removeForeignKey('FK_ORDER_ITEM');
            }

            $schema->dropTable('order_item');
        }

        if ($schema->hasTable('order_source')) {
            $table = $schema->getTable('order_source');

            if ($table->hasForeignKey('FK_LAST_USER_ORDER_SOURCE')) {
                $table->removeForeignKey('FK_LAST_USER_ORDER_SOURCE');
            }

            $schema->dropTable('order_source');
        }

        if ($schema->hasTable('order_status')) {
            $table = $schema->getTable('order_status');

            if ($table->hasForeignKey('FK_LAST_USER_ORDER_STATUS')) {
                $table->removeForeignKey('FK_LAST_USER_ORDER_STATUS');
            }

            $schema->dropTable('order_status');
        }

        if ($schema->hasTable('payment_type')) {
            $table = $schema->getTable('payment_type');

            if ($table->hasForeignKey('FK_LAST_USER_PAYMENT_TYPE')) {
                $table->removeForeignKey('FK_LAST_USER_PAYMENT_TYPE');
            }

            $schema->dropTable('payment_type');
        }

        if ($schema->hasTable('payment_status')) {
            $table = $schema->getTable('payment_status');

            if ($table->hasForeignKey('FK_LAST_USER_PAYMENT_STATUS')) {
                $table->removeForeignKey('FK_LAST_USER_PAYMENT_STATUS');
            }

            $schema->dropTable('payment_status');
        }

        if ($schema->hasTable('store_contact')) {
            $table = $schema->getTable('store_contact');

            if ($table->hasColumn('is_active')) {
                $table->dropIndex('is_active');
                $table->dropColumn('is_active');
            }
        }

        if ($schema->hasTable('client')) {
            $table = $schema->getTable('client');

            if ($table->hasIndex('is_active') && $table->hasIndex('is_deleted')) {
                $table->dropIndex('is_active');
                $table->dropIndex('is_deleted');
            }
            if ($table->hasColumn('is_active') && $table->hasColumn('is_deleted')) {
                $table->dropColumn('is_active');
                $table->dropColumn('is_deleted');
            }
        }
    }
}
