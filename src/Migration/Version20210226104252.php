<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210226104252 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('order_item')) {
            $table = $schema->getTable('order_item');

            if ( ! $table->hasColumn('currency')) {
                $table->addColumn('currency', 'string', ['notnull' => false, 'length' => 50]);
            }
        }

        if ($schema->hasTable('client_order')) {
            $table = $schema->getTable('client_order');

            if ($table->hasColumn('code')) {
                $table->changeColumn('code', ['notnull' => false]);
            }
            if ($table->hasColumn('shipment_date')) {
                $table->changeColumn('shipment_date', ['notnull' => false]);
            }
        }

    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('order_item')) {
            $table = $schema->getTable('order_item');

            if ($table->hasColumn('currency')) {
                $table->dropColumn('currency');
            }
        }

        if ($schema->hasTable('client_order')) {
            $table = $schema->getTable('client_order');

            if ($table->hasColumn('code')) {
                $table->changeColumn('code', ['notnull' => true]);
            }
            if ($table->hasColumn('shipment_date')) {
                $table->changeColumn('shipment_date', ['notnull' => true]);
            }
        }

    }
}
