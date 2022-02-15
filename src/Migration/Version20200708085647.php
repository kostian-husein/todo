<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 08.07.2020
 * Time: 09:27
 * Project: vds
 */

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Remove daemon_task table
 */
final class Version20200708085647 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription() : string
    {
        return 'Remove daemon_task table';
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('daemon_task')) {
            $schema->dropTable('daemon_task');
        }

        if ($schema->hasTable('sync')) {
            $table = $schema->getTable('sync');

            if (!$table->hasColumn('retry')) {
                $table->addColumn('retry', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            }
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('sync')) {
            $table = $schema->getTable('sync');

            if ($table->hasColumn('retry')) {
                $table->dropColumn('retry');
            }
        }
    }
}
