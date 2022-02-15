<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201204105911 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('store')) {
            $table = $schema->getTable('store');
            $table->addColumn('external_id', 'string', ['notnull' => true, 'length' => 255]);
        }
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('store')) {
            $table = $schema->getTable('store');
            $table->dropColumn('external_id');
        }
    }
}
