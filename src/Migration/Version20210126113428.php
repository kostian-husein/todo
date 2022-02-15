<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210126113428 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('user')) {
            $table = $schema->getTable('user');

            if ( ! $table->hasColumn('is_distributor')) {
                $table->addColumn('is_distributor', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
                $table->addIndex(['is_distributor'], 'is_distributor');
            }
        }
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('user')) {
            $table = $schema->getTable('user');

            if ($table->hasColumn('is_distributor')) {
                $table->dropColumn('is_distributor');
            }
        }
    }
}
