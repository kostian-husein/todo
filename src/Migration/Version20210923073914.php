<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210923073914 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        if ($schema->hasTable('user')) {
            $table = $schema->getTable('user');

            if (!$table->hasColumn('legal_name')) {
                $table->addColumn('legal_name', 'string', ['notnull' => false, 'length'=> 255]);
            }
        }
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('user')) {
            $table = $schema->getTable('user');

            if ($table->hasColumn('legal_name')) {
                $table->dropColumn('legal_name');
            }
        }
    }
}
