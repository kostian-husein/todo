<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210115121126 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('order_service')) {
            $table = $schema->getTable('order_service');

            if ($table->hasForeignKey('FK_SERVICE_PRICE_ORDER_SERVICE')) {
                $table->removeForeignKey('FK_SERVICE_PRICE_ORDER_SERVICE');
            }

            if ($table->hasColumn('service_price_id')) {
                $table->dropColumn('service_price_id');
            }
        }
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('order_service')) {
            $table = $schema->getTable('order_service');

            if ( ! $table->hasColumn('service_price_id')) {
                $table->addColumn('service_price_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
                $table->addIndex(['service_price_id'], 'service_price_id');
                $table->addForeignKeyConstraint('service_price', ['service_price_id'], ['service_price_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_SERVICE_PRICE_ORDER_SERVICE');
            }
        }
    }
}
