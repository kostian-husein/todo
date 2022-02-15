<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 21.07.2020
 * Time: 15:27
 * Project: vds
 */

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Add partner_coefficient column to geo coefficient tables
 */
final class Version20200721123830 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription() : string
    {
        return 'Add partner_coefficient column to geo coefficient tables';
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('city_coefficient')) {
            $table = $schema->getTable('city_coefficient');

            if (!$table->hasColumn('partner_coefficient')) {
                $table->addColumn('partner_coefficient', 'float', ['notnull' => false]);
            }
        }

        if ($schema->hasTable('region_coefficient')) {
            $table = $schema->getTable('region_coefficient');

            if (!$table->hasColumn('partner_coefficient')) {
                $table->addColumn('partner_coefficient', 'float', ['notnull' => false]);
            }
        }

        if ($schema->hasTable('country_coefficient')) {
            $table = $schema->getTable('country_coefficient');

            if (!$table->hasColumn('partner_coefficient')) {
                $table->addColumn('partner_coefficient', 'float', ['notnull' => false]);
            }
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('city_coefficient')) {
            $table = $schema->getTable('city_coefficient');

            if ($table->hasColumn('partner_coefficient')) {
                $table->dropColumn('partner_coefficient');
            }
        }

        if ($schema->hasTable('region_coefficient')) {
            $table = $schema->getTable('region_coefficient');

            if ($table->hasColumn('partner_coefficient')) {
                $table->dropColumn('partner_coefficient');
            }
        }

        if ($schema->hasTable('country_coefficient')) {
            $table = $schema->getTable('country_coefficient');

            if ($table->hasColumn('partner_coefficient')) {
                $table->dropColumn('partner_coefficient');
            }
        }
    }
}
