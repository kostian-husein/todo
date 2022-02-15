<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201217095547 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('user')) {
            $table = $schema->getTable('user');

            if ( ! $table->hasColumn('left')) {
                $table->addColumn('left', 'integer', ['unsigned' => true, 'notnull' => true]);
            }
            if ( ! $table->hasColumn('right')) {
                $table->addColumn('right', 'integer', ['unsigned' => true, 'notnull' => true]);
            }
            if ($table->hasColumn('path')) {
                $table->dropColumn('path');
            }
        }
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('user')) {
            $table = $schema->getTable('user');

            if ($table->hasColumn('left')) {
                $table->dropColumn('left');
            }
            if ($table->hasColumn('right')) {
                $table->dropColumn('right');
            }
        }
    }
}
