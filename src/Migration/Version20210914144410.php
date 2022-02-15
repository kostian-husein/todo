<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210914144410 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        if ($schema->hasTable('client_order')) {
            $table = $schema->getTable('client_order');

            if (!$table->hasColumn('contract_number')) {
                $table->addColumn('contract_number', 'string', ['notnull' => false, 'length' => 255, 'default' => null]);
            }
        }
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('client_order')) {
            $table = $schema->getTable('client_order');

            if ($table->hasColumn('contract_number')) {
                $table->dropColumn('contract_number');
            }
        }
    }
}
