<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210916103513 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        if ($schema->hasTable('order_item')) {
            $table = $schema->getTable('order_item');

            if (!$table->hasColumn('position')) {
                $table->addColumn('position', 'integer', ['unsigned' => true, 'notnull' => false]);
            }

            if ($table->hasColumn('code') && $table->hasIndex('code')) {
                $table->dropIndex('code');
            }

            if (! $table->hasIndex('code_position')) {
                $table->addUniqueIndex(['code', 'position'], 'code_position');
            }
        }
    }

    public function postUp(Schema $schema): void
    {
        $this->connection->executeStatement('UPDATE order_item SET position = 0');
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('order_item')) {
            $table = $schema->getTable('order_item');

            if ($table->hasColumn('position')) {
                $table->dropColumn('position');
            }

            if ($table->hasIndex('code_position')) {
                $table->dropIndex('code_position');
            }

            if ($table->hasColumn('code') && !$table->hasIndex('code')) {
                $table->addUniqueIndex(['code'],'code');
            }
        }
    }
}
