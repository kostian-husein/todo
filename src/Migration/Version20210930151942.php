<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 30.09.2021
 * Time: 18:20
 * Project: steelline
 */

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Add is_consignment field to client_order table
 */
final class Version20210930151942 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription() : string
    {
        return 'Add is_consignment field to client_order table';
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('client_order')) {
            $table = $schema->getTable('client_order');

            if (!$table->hasColumn('is_consignment')) {
                $table->addColumn('is_consignment', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
                $table->addIndex(['is_consignment'], 'is_consignment');
            }
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('client_order')) {
            $table = $schema->getTable('client_order');

            if ($table->hasColumn('is_consignment')) {
                $table->dropColumn('is_consignment');
            }
        }
    }
}
