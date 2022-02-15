<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210817074756 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        if ($schema->hasTable('client_order')) {
            $table = $schema->getTable('client_order');
            $table->addColumn('trade_price', 'decimal', ['unsigned' => true, 'notnull' => true, 'precision' => 20, 'scale' => 2, 'default' => 0]);
            $table->addColumn('factory_price', 'decimal', ['unsigned' => true, 'notnull' => true, 'precision' => 20, 'scale' => 2, 'default' => 0]);
            $table->addColumn('retail_price', 'decimal', ['unsigned' => true, 'notnull' => true, 'precision' => 20, 'scale' => 2, 'default' => 0]);
        }
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('client_order')) {
            $table = $schema->getTable('client_order');
            $table->dropColumn('trade_price');
            $table->dropColumn('factory_price');
            $table->dropColumn('retail_price');
        }
    }
}
