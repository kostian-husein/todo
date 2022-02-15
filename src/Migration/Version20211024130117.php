<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211024130117 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        if ($schema->hasTable('order_item')) {
            $table = $schema->getTable('order_item');

            if (!$table->hasColumn('main_order_label')) {
                $table->addColumn('main_order_label', 'string', ['notnull' => false, 'length' => 255]);
            }
        }
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('order_item')) {
            $table = $schema->getTable('order_item');

            if ($table->hasColumn('main_order_label')) {
                $table->dropColumn('main_order_label');
            }
        }
    }
}
