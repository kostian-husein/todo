<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210831162014 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        if (!$schema->hasTable('notification_changelog')) {
            $table = $schema->createTable('notification_changelog');

            $table->addColumn('id', 'integer', ['autoincrement' => true, 'unsigned' => true, 'notnull' => true]);
            $table->addColumn('user_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('changelog_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);

            $table->addIndex(['user_id'], 'user_id');
            $table->addIndex(['changelog_id'], 'order_id');
            $table->addIndex(['is_active'], 'is_active');
            $table->addIndex(['is_deleted'], 'is_deleted');

            $table->addUniqueIndex(['user_id', 'changelog_id'], 'user_changelog_id');
            $table->setPrimaryKey(['id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения оповещений для истории обновления системы');

            $table->addForeignKeyConstraint('user', ['user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_CHANGELOG_USER_NOTIFICATION');
            $table->addForeignKeyConstraint('changelog', ['changelog_id'], ['id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_CHANGELOG_NOTIFICATION');
        }

        if (!$schema->hasTable('notification_news')) {
            $table = $schema->createTable('notification_news');

            $table->addColumn('id', 'integer', ['autoincrement' => true, 'unsigned' => true, 'notnull' => true]);
            $table->addColumn('user_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('news_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);

            $table->addIndex(['user_id'], 'user_id');
            $table->addIndex(['news_id'], 'news_id');
            $table->addIndex(['is_active'], 'is_active');
            $table->addIndex(['is_deleted'], 'is_deleted');

            $table->addUniqueIndex(['user_id', 'news_id'], 'user_news_id');
            $table->setPrimaryKey(['id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения оповещений для новостей системы');

            $table->addForeignKeyConstraint('user', ['user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_NEWS_USER_NOTIFICATION');
            $table->addForeignKeyConstraint('news', ['news_id'], ['news_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_NEWS_NOTIFICATION');
        }

        if (!$schema->hasTable('notification_order')) {
            $table = $schema->createTable('notification_order');

            $table->addColumn('id', 'integer', ['autoincrement' => true, 'unsigned' => true, 'notnull' => true]);
            $table->addColumn('user_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('order_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('type', 'string', ['notnull' => true, 'default' => 'changing']);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);

            $table->addIndex(['user_id'], 'user_id');
            $table->addIndex(['order_id'], 'order_id');
            $table->addIndex(['is_active'], 'is_active');
            $table->addIndex(['is_deleted'], 'is_deleted');

            $table->setPrimaryKey(['id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения оповещений для Заказов');

            $table->addForeignKeyConstraint('user', ['user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_ORDER_USER_NOTIFICATION');
            $table->addForeignKeyConstraint('client_order', ['order_id'], ['order_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_ORDER_NOTIFICATION');
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\DBALException
     */
    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery('ALTER TABLE notification_order MODIFY type ENUM("processing", "changing", "comment") NOT NULL DEFAULT "changing"');
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('notification_order')) {
            $table = $schema->getTable('notification_order');
            if ($table->hasForeignKey('FK_ORDER_USER_NOTIFICATION')) {
                $table->removeForeignKey('FK_ORDER_USER_NOTIFICATION');
            }
            if ($table->hasForeignKey('FK_ORDER_NOTIFICATION')) {
                $table->removeForeignKey('FK_ORDER_NOTIFICATION');
            }
            $schema->dropTable('notification_order');
        }

        if ($schema->hasTable('notification_news')) {
            $table = $schema->getTable('notification_news');
            if ($table->hasForeignKey('FK_NEWS_USER_NOTIFICATION')) {
                $table->removeForeignKey('FK_NEWS_USER_NOTIFICATION');
            }
            if ($table->hasForeignKey('FK_NEWS_NOTIFICATION')) {
                $table->removeForeignKey('FK_NEWS_NOTIFICATION');
            }
            $schema->dropTable('notification_news');
        }

        if ($schema->hasTable('notification_changelog')) {
            $table = $schema->getTable('notification_changelog');
            if ($table->hasForeignKey('FK_CHANGELOG_USER_NOTIFICATION')) {
                $table->removeForeignKey('FK_CHANGELOG_USER_NOTIFICATION');
            }
            if ($table->hasForeignKey('FK_CHANGELOG_NOTIFICATION')) {
                $table->removeForeignKey('FK_CHANGELOG_NOTIFICATION');
            }
            $schema->dropTable('notification_changelog');
        }
    }
}
