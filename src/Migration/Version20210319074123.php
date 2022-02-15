<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210319074123 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('client_order')) {
            $table = $schema->getTable('client_order');

            if ($table->hasColumn('client_price')) {
                $table->dropColumn('client_price');
            }
        }

        if ($schema->hasTable('order_item')) {
            $table = $schema->getTable('order_item');

            if ( ! $table->hasColumn('client_price')) {
                $table->addColumn('client_price', 'decimal', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            }
        }
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('order_item')) {
            $table = $schema->getTable('order_item');

            $table->dropColumn('client_price');
        }
    }
}
