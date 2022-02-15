<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Class Version20200626082922
 * @package Application\Migration
 */
final class Version20200626082922 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('user')) {
            $table = $schema->getTable('user');

            if ($table->hasColumn('country_id')) {
                $table->changeColumn('country_id', ['notnull' => false]);
                $table->changeColumn('region_id', ['notnull' => false]);
                $table->changeColumn('city_id', ['notnull' => false]);
            }
        }
    }

    public function down(Schema $schema) : void
    {

    }
}
