<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 26.10.2021
 * Time: 16:20
 * Project: steelline
 */

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Add external_id columns to geo tables
 */
final class Version20211026132943 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription() : string
    {
        return 'Add external_id columns to geo tables';
    }

    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('country')) {
            $table = $schema->getTable('country');

            if (!$table->hasColumn('external_id')) {
                $table->addColumn('external_id', 'string', ['length' => 255, 'notnull' => false, 'default' => null]);
                $table->addUniqueIndex(['external_id'], 'external_id');
            }
        }

        if ($schema->hasTable('region')) {
            $table = $schema->getTable('region');

            if (!$table->hasColumn('external_id')) {
                $table->addColumn('external_id', 'string', ['length' => 255, 'notnull' => false, 'default' => null]);
                $table->addUniqueIndex(['external_id'], 'external_id');
            }
        }

        if ($schema->hasTable('city')) {
            $table = $schema->getTable('city');

            if (!$table->hasColumn('external_id')) {
                $table->addColumn('external_id', 'string', ['length' => 255, 'notnull' => false, 'default' => null]);
                $table->addUniqueIndex(['external_id'], 'external_id');
            }
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('country')) {
            $table = $schema->getTable('country');

            if ($table->hasColumn('external_id')) {
                $table->dropColumn('external_id');
            }
        }

        if ($schema->hasTable('region')) {
            $table = $schema->getTable('region');

            if ($table->hasColumn('external_id')) {
                $table->dropColumn('external_id');
            }
        }

        if ($schema->hasTable('city')) {
            $table = $schema->getTable('city');

            if ($table->hasColumn('external_id')) {
                $table->dropColumn('external_id');
            }
        }
    }
}
