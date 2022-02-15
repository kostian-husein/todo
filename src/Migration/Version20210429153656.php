<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210429153656 extends AbstractMigration
{

    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('client')) {
            $table = $schema->getTable('client');

            $table->changeColumn('region_id', ['notnull' => false]);
            $table->changeColumn('city_id', ['notnull' => false]);
            $table->changeColumn('last_name', ['notnull' => false]);
            $table->changeColumn('patronymic', ['notnull' => false]);
            $table->changeColumn('address', ['notnull' => false]);
            $table->changeColumn('passport_id', ['notnull' => false]);
            $table->changeColumn('delivery_address', ['notnull' => false]);
        }
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('client')) {
            $table = $schema->getTable('client');

            $table->changeColumn('region_id', ['notnull' => true]);
            $table->changeColumn('city_id', ['notnull' => true]);
            $table->changeColumn('last_name', ['notnull' => true]);
            $table->changeColumn('patronymic', ['notnull' => true]);
            $table->changeColumn('address', ['notnull' => true]);
            $table->changeColumn('passport_id', ['notnull' => true]);
            $table->changeColumn('delivery_address', ['notnull' => true]);
        }
    }
}
