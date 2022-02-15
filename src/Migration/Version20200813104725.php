<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 13.08.2020
 * Time: 13:48
 * Project: vds
 */

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Add delivery_price columns
 */
final class Version20200813104725 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription() : string
    {
        return 'Add delivery_price columns';
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('city_coefficient')) {
            $table = $schema->getTable('city_coefficient');

            if (!$table->hasColumn('delivery_price')) {
                $table->addColumn('delivery_price', 'decimal', ['notnull' => false, 'default' => null]);
            }

            if (!$table->hasColumn('delivery_price_extra')) {
                $table->addColumn('delivery_price_extra', 'decimal', ['notnull' => false, 'default' => null]);
            }

            if (!$table->hasColumn('partner_delivery_price')) {
                $table->addColumn('partner_delivery_price', 'decimal', ['notnull' => false, 'default' => null]);
            }

            if (!$table->hasColumn('partner_delivery_price_extra')) {
                $table->addColumn('partner_delivery_price_extra', 'decimal', ['notnull' => false, 'default' => null]);
            }
        }

        if ($schema->hasTable('region_coefficient')) {
            $table = $schema->getTable('region_coefficient');

            if (!$table->hasColumn('delivery_price')) {
                $table->addColumn('delivery_price', 'decimal', ['notnull' => false, 'default' => null]);
            }

            if (!$table->hasColumn('delivery_price_extra')) {
                $table->addColumn('delivery_price_extra', 'decimal', ['notnull' => false, 'default' => null]);
            }

            if (!$table->hasColumn('partner_delivery_price')) {
                $table->addColumn('partner_delivery_price', 'decimal', ['notnull' => false, 'default' => null]);
            }

            if (!$table->hasColumn('partner_delivery_price_extra')) {
                $table->addColumn('partner_delivery_price_extra', 'decimal', ['notnull' => false, 'default' => null]);
            }
        }

        if ($schema->hasTable('country_coefficient')) {
            $table = $schema->getTable('country_coefficient');

            if (!$table->hasColumn('delivery_price')) {
                $table->addColumn('delivery_price', 'decimal', ['notnull' => false, 'default' => null]);
            }

            if (!$table->hasColumn('delivery_price_extra')) {
                $table->addColumn('delivery_price_extra', 'decimal', ['notnull' => false, 'default' => null]);
            }

            if (!$table->hasColumn('partner_delivery_price')) {
                $table->addColumn('partner_delivery_price', 'decimal', ['notnull' => false, 'default' => null]);
            }

            if (!$table->hasColumn('partner_delivery_price_extra')) {
                $table->addColumn('partner_delivery_price_extra', 'decimal', ['notnull' => false, 'default' => null]);
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

            if ($table->hasColumn('delivery_price')) {
                $table->dropColumn('delivery_price');
            }

            if ($table->hasColumn('delivery_price_extra')) {
                $table->dropColumn('delivery_price_extra');
            }

            if ($table->hasColumn('partner_delivery_price')) {
                $table->dropColumn('partner_delivery_price');
            }

            if ($table->hasColumn('partner_delivery_price_extra')) {
                $table->dropColumn('partner_delivery_price_extra');
            }
        }

        if ($schema->hasTable('region_coefficient')) {
            $table = $schema->getTable('region_coefficient');

            if ($table->hasColumn('delivery_price')) {
                $table->dropColumn('delivery_price');
            }

            if ($table->hasColumn('delivery_price_extra')) {
                $table->dropColumn('delivery_price_extra');
            }

            if ($table->hasColumn('partner_delivery_price')) {
                $table->dropColumn('partner_delivery_price');
            }

            if ($table->hasColumn('partner_delivery_price_extra')) {
                $table->dropColumn('partner_delivery_price_extra');
            }
        }

        if ($schema->hasTable('country_coefficient')) {
            $table = $schema->getTable('country_coefficient');

            if ($table->hasColumn('delivery_price')) {
                $table->dropColumn('delivery_price');
            }

            if ($table->hasColumn('delivery_price_extra')) {
                $table->dropColumn('delivery_price_extra');
            }

            if ($table->hasColumn('partner_delivery_price')) {
                $table->dropColumn('partner_delivery_price');
            }

            if ($table->hasColumn('partner_delivery_price_extra')) {
                $table->dropColumn('partner_delivery_price_extra');
            }
        }
    }
}
