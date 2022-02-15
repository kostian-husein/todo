<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210527132508 extends AbstractMigration
{

    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('order_service')) {
            $table = $schema->getTable('order_service');

            $table->addColumn('price', 'decimal', ['unsigned' => true, 'notnull' => true, 'precision' => 20, 'scale' => 2, 'default' => 0]);
            $table->addColumn('currency', 'string', ['notnull' => true, 'length' => 50]);
        }
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('order_service')) {
            $table = $schema->getTable('order_service');

            $table->dropColumn('price');
            $table->dropColumn('currency');
        }
    }
}
