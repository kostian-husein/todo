<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211117092948 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Remove column `bitrix_number` from `client_order` to `order_item`';
    }

    public function up(Schema $schema): void
    {
        if ($schema->hasTable('order_item')) {
            $table = $schema->getTable('order_item');

            if (!$table->hasColumn('bitrix_number')) {
                $table->addColumn('bitrix_number', 'string', ['notnull' => false, 'length' => 255, 'default' => null]);
            }
        }
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('order_item')) {
            $table = $schema->getTable('order_item');
            if ($table->hasColumn('bitrix_number')) {
                $table->dropColumn('bitrix_number');
            }
        }
    }
}
