<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210722121931 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        if ($schema->hasTable('client_order')) {
            $table = $schema->getTable('client_order');

            $table->dropColumn('code');
        }
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('client_order')) {
            $table = $schema->getTable('client_order');

            $table->addColumn('code', 'string', ['notnull' => false, 'length' => 50]);
        }
    }
}
