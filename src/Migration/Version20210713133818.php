<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210713133818 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        if ($schema->hasTable('client_order')) {
            $table = $schema->getTable('client_order');

            if ($table->hasColumn('label')) {
                $table->dropColumn('label');
                $table->addColumn('label', 'string', ['notnull' => false, 'length' => 255]);
            }
        }
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('client_order')) {
            $table = $schema->getTable('client_order');

            if ($table->hasColumn('label')) {
                $table->dropColumn('label');
                $table->addColumn('label', 'string', ['notnull' => true, 'length' => 255]);
            }
        }
    }
}
