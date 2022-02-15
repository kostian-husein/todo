<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210913085554 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        if ($schema->hasTable('user')) {
            $table = $schema->getTable('user');
            $table->addColumn('is_tested', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
        }
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('user')) {
            $table = $schema->getTable('user');
            $table->dropColumn('is_tested');
        }
    }
}
