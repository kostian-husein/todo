<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210927094109 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        if ($schema->hasTable('notification_changelog')) {
            $table = $schema->getTable('notification_changelog');

            if ($table->hasIndex('order_id')) {
                $table->dropIndex('order_id');
                $table->addIndex(['changelog_id'], 'changelog_id');
            }
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Exception
     */
    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery('TRUNCATE TABLE notification_order;');
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('notification_changelog')) {
            $table = $schema->getTable('notification_changelog');

            if ($table->hasIndex('changelog_id')) {
                $table->dropIndex('changelog_id');
                $table->addIndex(['changelog_id'], 'order_id');
            }
        }
    }
}
