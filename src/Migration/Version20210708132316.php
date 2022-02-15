<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210708132316 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        if ($schema->hasTable('news_images')) {
            $table = $schema->getTable('news_images');

            if ($table->hasForeignKey('FK_NEWS_IMAGE')) {
                $table->removeForeignKey('FK_NEWS_IMAGE');
            }

            if (!$table->hasForeignKey('FK_NEWS_IMAGE')) {
                $schema->renameTable('news_images', 'news_image');
            }

            if ($schema->hasTable('news_image')) {
                $table = $schema->getTable('news_image');
                $table->addForeignKeyConstraint('news', ['news_id'], ['news_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_NEWS_IMAGES');
            }
        }
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('news_image')) {
            $table = $schema->getTable('news_image');

            if ($table->hasForeignKey('FK_NEWS_IMAGES')) {
                $table->removeForeignKey('FK_NEWS_IMAGES');
            }

            if (!$table->hasForeignKey('FK_NEWS_IMAGES')) {
                $schema->renameTable('news_image', 'news_images');
            }

            if ($schema->hasTable('news_images')) {
                $table = $schema->getTable('news_images');
                $table->addForeignKeyConstraint('news', ['news_id'], ['news_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_NEWS_IMAGE');
            }
        }
    }
}
