<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Class Version20210322113623
 * @package Application\Migration
 */
final class Version20210322113623 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('order_item')) {
            $table = $schema->getTable('order_item');

            if ( ! $table->hasColumn('nomenclature_id')) {
                $table->addColumn('nomenclature_id', 'string', ['notnull' => false, 'length' => 255]);
                $table->addIndex(['nomenclature_id'], 'nomenclature_id');
            }
        }

        if ($schema->hasTable('client_order')) {
            $table = $schema->getTable('client_order');

            if ($table->hasColumn('external_id')) {
                $table->dropColumn('external_id');
            }
        }
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('order_item')) {
            $table = $schema->getTable('order_item');

            if ($table->hasColumn('nomenclature_id')) {
                $table->dropColumn('nomenclature_id');
            }
        }

        if ($schema->hasTable('client_order')) {
            $table = $schema->getTable('client_order');

            if ( ! $table->hasColumn('external_id')) {
                $table->addColumn('external_id', 'string', ['length' => 255, 'notnull' => false]);
            }
        }
    }
}
