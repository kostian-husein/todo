<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201001054812 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('parameter')) {
            $table = $schema->getTable('parameter');
            if ( ! $table->hasColumn('alias_key')) {
                $table->addColumn('alias_key', 'string', ['notnull' => false, 'length' => 255]);
            }
        }
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('parameter')) {
            $table = $schema->getTable('parameter');
            if ($table->hasColumn('alias_key')) {
                $table->dropColumn('alias_key');
            }
        }
    }
}
