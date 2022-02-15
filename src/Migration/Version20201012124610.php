<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 13.10.2020
 * Time: 15:49
 * Project: steellinevds
 */

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Add company column to user table
 */
final class Version20201012124610 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription() : string
    {
        return 'Add company column to user table';
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('user')) {
            $table = $schema->getTable('user');

            if (!$table->hasColumn('company')) {
                $table->addColumn('company', 'string');
            }
        }

        if ($schema->hasTable('city_coefficient')) {
            $table = $schema->getTable('city_coefficient');

            if (!$table->hasColumn('coefficient_sun')) {
                $table->addColumn('coefficient_sun', 'float', ['notnull' => false]);
            }

            if (!$table->hasColumn('partner_coefficient_sun')) {
                $table->addColumn('partner_coefficient_sun', 'float', ['notnull' => false]);
            }
        }

        if ($schema->hasTable('region_coefficient')) {
            $table = $schema->getTable('region_coefficient');

            if (!$table->hasColumn('coefficient_sun')) {
                $table->addColumn('coefficient_sun', 'float', ['notnull' => false]);
            }

            if (!$table->hasColumn('partner_coefficient_sun')) {
                $table->addColumn('partner_coefficient_sun', 'float', ['notnull' => false]);
            }
        }

        if ($schema->hasTable('country_coefficient')) {
            $table = $schema->getTable('country_coefficient');

            if (!$table->hasColumn('coefficient_sun')) {
                $table->addColumn('coefficient_sun', 'float', ['notnull' => false]);
            }

            if (!$table->hasColumn('partner_coefficient_sun')) {
                $table->addColumn('partner_coefficient_sun', 'float', ['notnull' => false]);
            }
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\DBALException
     */
    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery('UPDATE `user` SET `company` = "steelline"');
        $this->connection->executeQuery('ALTER TABLE `user` MODIFY `company` ENUM("steelline", "sun") NOT NULL DEFAULT "steelline"');
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('user')) {
            $table = $schema->getTable('user');

            if ($table->hasColumn('company')) {
                $table->dropColumn('company');
            }
        }

        if ($schema->hasTable('city_coefficient')) {
            $table = $schema->getTable('city_coefficient');

            if ($table->hasColumn('coefficient_sun')) {
                $table->dropColumn('coefficient_sun');
            }

            if ($table->hasColumn('partner_coefficient_sun')) {
                $table->dropColumn('partner_coefficient_sun');
            }
        }

        if ($schema->hasTable('region_coefficient')) {
            $table = $schema->getTable('region_coefficient');

            if ($table->hasColumn('coefficient_sun')) {
                $table->dropColumn('coefficient_sun');
            }

            if ($table->hasColumn('partner_coefficient_sun')) {
                $table->dropColumn('partner_coefficient_sun');
            }
        }

        if ($schema->hasTable('country_coefficient')) {
            $table = $schema->getTable('country_coefficient');

            if ($table->hasColumn('coefficient_sun')) {
                $table->dropColumn('coefficient_sun');
            }

            if ($table->hasColumn('partner_coefficient_sun')) {
                $table->dropColumn('partner_coefficient_sun');
            }
        }
    }
}
