<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210608063723 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        if ($schema->hasTable('client_order')) {
            $table = $schema->getTable('client_order');

            if (! $table->hasColumn('is_sample')) {
                $table->addColumn('is_sample', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            }

            if (! $table->hasColumn('main_order_sample')) {
                $table->addColumn('main_order_sample', 'string', ['notnull' => false]);
            }
        }
    }

    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery("ALTER TABLE `client_order` MODIFY `main_order_sample` ENUM('scheduled_replacement', 'opening_new_shop', 'upgrade_status_shop', 'replacement_for_black_friday') NULL;");
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('client_order')) {
            $table = $schema->getTable('client_order');

            if ($table->hasColumn('is_sample')) {
                $table->dropColumn('is_sample');
            }

            if ($table->hasColumn('main_order_sample')) {
                $table->dropColumn('main_order_sample');
            }
        }
    }
}
