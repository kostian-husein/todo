<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210607065824 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        if ($schema->hasTable('order_history')) {
            $table = $schema->getTable('order_history');

            if ($table->hasColumn('updated_at')) {
                $table->dropColumn('updated_at');
            }

            if ( ! $table->hasColumn('action')) {
                $table->addColumn('action', 'string', ['notnull' => true, 'default' => 'custom']);
            }
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\DBALException
     */
    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery('ALTER TABLE order_history MODIFY action ENUM("create", "update", "delete", "restore", "deactivate", "activate", "custom") NOT NULL DEFAULT "custom"');
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('order_history')) {
            $table = $schema->getTable('order_history');

            if ( ! $table->hasColumn('updated_at')) {
                $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            }

            if ($table->hasColumn('action')) {
                $table->dropColumn('action');
            }
        }
    }
}
