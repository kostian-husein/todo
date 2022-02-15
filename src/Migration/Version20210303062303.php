<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210303062303 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('client')) {
            $table = $schema->getTable('client');
            $table->addColumn('delivery_address', 'json', ['notnull' => true]);
        }
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('client')) {
            $table = $schema->getTable('client');
            $table->dropColumn('delivery_address');
        }
    }
}
