<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210105090841 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('client_order')) {
            $table = $schema->getTable('client_order');
            if ($table->hasColumn('shipment_date')) {
                $table->dropColumn('shipment_date');
                $table->addColumn('shipment_date', 'date', ['notnull' => true]);
            }
        }
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('client_order')) {
            $table = $schema->getTable('client_order');
            if ($table->hasColumn('shipment_date')) {
                $table->dropColumn('shipment_date');
                $table->addColumn('shipment_date', 'datetime', ['notnull' => true]);
            }
        }
    }
}
