<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210708091726 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        if ($schema->hasTable('client_order')) {
            $table = $schema->getTable('client_order');

            $table->addColumn('bitrix_number', 'integer', ['unsigned' => true, 'notnull' => false]);
        }
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('client_order')) {
            $table = $schema->getTable('client_order');

            $table->dropColumn('bitrix_number');
        }
    }
}
