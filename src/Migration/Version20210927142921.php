<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210927142921 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        if ($schema->hasTable('order_item')) {
            $table = $schema->getTable('order_item');

            if (!$table->hasColumn('main_item_id')) {
                $table->addColumn('main_item_id', 'integer', ['unsigned' => true, 'notnull' => false]);
                $table->addIndex(['main_item_id'], 'main_item_id');

                $table->addForeignKeyConstraint('order_item', ['main_item_id'], ['item_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_ORDER_ITEM_MAIN_ORDER');
            }

            if (!$table->hasColumn('main_order_external_id')) {
                $table->addColumn('main_order_external_id', 'string', ['notnull' => false, 'length' => 100]);
            }

            if (!$table->hasColumn('send_to_1c')) {
                $table->addColumn('send_to_1c', 'datetime', ['notnull' => false]);
            }
        }
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('order_item')) {
            $table = $schema->getTable('order_item');
            if ($table->hasColumn('main_order')) {
                $table->dropColumn('main_order');
            }

            if ($table->hasColumn('main_item_id')) {
                if ($table->hasForeignKey('FK_ORDER_ITEM_MAIN_ORDER')) {
                    $table->removeForeignKey('FK_ORDER_ITEM_MAIN_ORDER');
                }
                $table->dropIndex('main_item_id');
                $table->dropColumn('main_item_id');
            }

            if ($table->hasColumn('main_order_external_id')) {
                $table->dropColumn('main_order_external_id');
            }
            if ($table->hasColumn('send_to_1c')) {
                $table->dropColumn('send_to_1c');
            }
        }
    }
}
