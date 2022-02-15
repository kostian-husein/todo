<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210624111259 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        if (!$schema->hasTable('news')){
            $table = $schema->createTable('news');

            $table->addColumn('news_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('news_type', 'string', ['notnull' => true, 'default' => 'all']);
            $table->addColumn('label', 'string', ['notnull' => true, 'length' => 255]);

            $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => false, 'default' => null]);

            $table->addColumn('announce', 'text', ['notnull' => false]);
            $table->addColumn('content', 'text', ['notnull' => false]);

            $table->addColumn('head_image', 'string', ['notnull' => false, 'length' => 50]);
            $table->addColumn('head_image_real_filename', 'string', ['notnull' => false, 'length' => 255]);
            $table->addColumn('head_image_size', 'integer', ['unsigned' => true, 'notnull' => false]);

            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);

            $table->setPrimaryKey(['news_id']);

            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения новостей');

            $table->addIndex(['last_user_id'], 'last_user_id');
            $table->addIndex(['is_active'], 'is_active');
            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addUniqueIndex(['label'], 'label');

            $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_NEWS');
        }

        if (!$schema->hasTable('news_images')) {
            $table = $schema->createTable('news_images');

            $table->addColumn('id', 'integer', ['autoincrement' => true, 'unsigned' => true, 'notnull' => true]);
            $table->addColumn('news_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('image', 'string', ['notnull' => false, 'length' => 50]);
            $table->addColumn('image_real_filename', 'string', ['notnull' => false, 'length' => 255]);
            $table->addColumn('image_size', 'integer', ['unsigned' => true, 'notnull' => false]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);

            $table->addIndex(['news_id'], 'comment_id');
            $table->addIndex(['is_deleted'], 'is_deleted');

            $table->addUniqueIndex(['id'], 'id');
            $table->setPrimaryKey(['id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения изображений для новостей');

            $table->addForeignKeyConstraint('news', ['news_id'], ['news_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_NEWS_IMAGE');
        }
    }

    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery("ALTER TABLE `news` MODIFY `news_type` ENUM('steelline', 'sun', 'all') NOT NULL DEFAULT 'all';");
    }

    public function down(Schema $schema): void
    {
        if ($schema->getTable('news_images')->hasForeignKey('FK_NEWS_IMAGE')) {
            $schema->getTable('news_images')->removeForeignKey('FK_NEWS_IMAGE');
        }
        if ($schema->getTable('news')->hasForeignKey('FK_USER_NEWS')) {
            $schema->getTable('news')->removeForeignKey('FK_USER_NEWS');
        }
        $schema->dropTable('news_images');
        $schema->dropTable('news');
    }
}
