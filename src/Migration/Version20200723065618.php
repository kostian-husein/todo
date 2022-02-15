<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 23.07.2020
 * Time: 10:12
 * Project: vds
 */

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Add partner_marker_coefficient to coefficient tables
 */
final class Version20200723065618 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription() : string
    {
        return 'Add partner_marker_coefficient to coefficient tables';
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('city_coefficient')) {
            $table = $schema->getTable('city_coefficient');

            if (!$table->hasColumn('partner_marker_coefficient')) {
                $table->addColumn('partner_marker_coefficient', 'float', ['notnull' => false]);
            }
        }

        if ($schema->hasTable('region_coefficient')) {
            $table = $schema->getTable('region_coefficient');

            if (!$table->hasColumn('partner_marker_coefficient')) {
                $table->addColumn('partner_marker_coefficient', 'float', ['notnull' => false]);
            }
        }

        if ($schema->hasTable('country_coefficient')) {
            $table = $schema->getTable('country_coefficient');

            if (!$table->hasColumn('partner_marker_coefficient')) {
                $table->addColumn('partner_marker_coefficient', 'float', ['notnull' => false]);
            }
        }

        if ($schema->hasTable('attendant_parameter')) {
            $table = $schema->getTable('attendant_parameter');

            if (!$table->hasColumn('attendant_value_str')) {
                $table->addColumn('attendant_value_str', 'string', ['notnull' => false, 'length' => 50, 'default' => null]);
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

            if ($table->hasColumn('partner_marker_coefficient')) {
                $table->dropColumn('partner_marker_coefficient');
            }
        }

        if ($schema->hasTable('region_coefficient')) {
            $table = $schema->getTable('region_coefficient');

            if ($table->hasColumn('partner_marker_coefficient')) {
                $table->dropColumn('partner_marker_coefficient');
            }
        }

        if ($schema->hasTable('country_coefficient')) {
            $table = $schema->getTable('country_coefficient');

            if ($table->hasColumn('partner_marker_coefficient')) {
                $table->dropColumn('partner_marker_coefficient');
            }
        }

        if ($schema->hasTable('attendant_parameter')) {
            $table = $schema->getTable('attendant_parameter');

            if ($table->hasColumn('attendant_value_str')) {
                $table->dropColumn('attendant_value_str');
            }
        }
    }
}
