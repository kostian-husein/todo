<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210917094429 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        if ($schema->hasTable('order_item')) {
            $table = $schema->getTable('order_item');

            if (!$table->hasColumn('customer_number')) {
                $table->addColumn('customer_number', 'string', ['notnull' => false, 'length' => 255, 'default' => null]);
            }
        }
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('order_item')) {
            $table = $schema->getTable('order_item');

            if ($table->hasColumn('customer_number')) {
                $table->dropColumn('customer_number');
            }
        }
    }
}
