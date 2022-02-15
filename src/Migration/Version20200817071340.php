<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 13.08.2020
 * Time: 13:48
 * Project: vds
 */

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Add "user access control" columns to parameter_value table
 */
final class Version20200817071340 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription() : string
    {
        return 'Add "user access control" columns to parameter_value table';
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('parameter_value')) {
            $table = $schema->getTable('parameter_value');

            if (!$table->hasColumn('for_users')) {
                $table->addColumn('for_users', 'string', ['length' => 1000, 'notnull' => true]);
            }

            if (!$table->hasColumn('except_users')) {
                $table->addColumn('except_users', 'string', ['length' => 1000, 'notnull' => true]);
            }
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('parameter_value')) {
            $table = $schema->getTable('parameter_value');

            if ($table->hasColumn('for_users')) {
                $table->dropColumn('for_users');
            }

            if (!$table->hasColumn('except_users')) {
                $table->dropColumn('except_users');
            }
        }
    }
}
