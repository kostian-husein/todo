<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 16.09.2021
 * Time: 12:22
 * Project: vds
 */

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Add product_type_id column to geo coefficient tables
 */
final class Version20210916124249 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription() : string
    {
        return 'Add product_type_id column to geo coefficient tables';
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('city_coefficient')) {
            $table = $schema->getTable('city_coefficient');

            if (!$table->hasColumn('product_type_id')) {
                $table->addColumn('product_type_id', 'integer', ['unsigned' => true, 'notnull' => false, 'default' => null]);

                $table->addIndex(['product_type_id'], 'product_type_id');
                $table->addForeignKeyConstraint('product_type', ['product_type_id'], ['product_type_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_CITY_COEFFICIENT_PRODUCT_TYPE');
            }

            if (!$table->hasForeignKey('FK_CITY_COEFFICIENT_CITY')) {
                $table->addForeignKeyConstraint('city', ['city_id'], ['city_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_CITY_COEFFICIENT_CITY');
            }
        }

        if ($schema->hasTable('region_coefficient')) {
            $table = $schema->getTable('region_coefficient');

            if (!$table->hasColumn('product_type_id')) {
                $table->addColumn('product_type_id', 'integer', ['unsigned' => true, 'notnull' => false, 'default' => null]);

                $table->addIndex(['product_type_id'], 'product_type_id');
                $table->addForeignKeyConstraint('product_type', ['product_type_id'], ['product_type_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_REGION_COEFFICIENT_PRODUCT_TYPE');
            }
        }

        if ($schema->hasTable('country_coefficient')) {
            $table = $schema->getTable('country_coefficient');

            if (!$table->hasColumn('product_type_id')) {
                $table->addColumn('product_type_id', 'integer', ['unsigned' => true, 'notnull' => false, 'default' => null]);

                $table->addIndex(['product_type_id'], 'product_type_id');
                $table->addForeignKeyConstraint('product_type', ['product_type_id'], ['product_type_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_COUNTRY_COEFFICIENT_PRODUCT_TYPE');
            }
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Doctrine\DBAL\Exception
     * @throws \Doctrine\Migrations\Exception\MigrationException
     */
    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery('ALTER TABLE `city_coefficient` MODIFY `value_id` INT(10) UNSIGNED NULL DEFAULT NULL');
        $this->connection->executeQuery('ALTER TABLE `region_coefficient` MODIFY `value_id` INT(10) UNSIGNED NULL DEFAULT NULL');
        $this->connection->executeQuery('ALTER TABLE `country_coefficient` MODIFY `value_id` INT(10) UNSIGNED NULL DEFAULT NULL');
        parent::postUp($schema);
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('city_coefficient')) {
            $table = $schema->getTable('city_coefficient');

            if ($table->hasForeignKey('FK_CITY_COEFFICIENT_PRODUCT_TYPE')) {
                $table->removeForeignKey('FK_CITY_COEFFICIENT_PRODUCT_TYPE');
            }

            if ($table->hasColumn('product_type_id')) {
                $table->dropColumn('product_type_id');
            }
        }

        if ($schema->hasTable('region_coefficient')) {
            $table = $schema->getTable('region_coefficient');

            if ($table->hasForeignKey('FK_REGION_COEFFICIENT_PRODUCT_TYPE')) {
                $table->removeForeignKey('FK_REGION_COEFFICIENT_PRODUCT_TYPE');
            }

            if ($table->hasColumn('product_type_id')) {
                $table->dropColumn('product_type_id');
            }
        }

        if ($schema->hasTable('country_coefficient')) {
            $table = $schema->getTable('country_coefficient');

            if ($table->hasForeignKey('FK_COUNTRY_COEFFICIENT_PRODUCT_TYPE')) {
                $table->removeForeignKey('FK_COUNTRY_COEFFICIENT_PRODUCT_TYPE');
            }

            if ($table->hasColumn('product_type_id')) {
                $table->dropColumn('product_type_id');
            }
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Doctrine\DBAL\Exception
     * @throws \Doctrine\Migrations\Exception\MigrationException
     */
    public function postDown(Schema $schema): void
    {
        $this->connection->executeQuery('ALTER TABLE `city_coefficient` MODIFY `value_id` INT(10) UNSIGNED NOT NULL');
        $this->connection->executeQuery('ALTER TABLE `region_coefficient` MODIFY `value_id` INT(10) UNSIGNED NOT NULL');
        $this->connection->executeQuery('ALTER TABLE `country_coefficient` MODIFY `value_id` INT(10) UNSIGNED NOT NULL');
        parent::postDown($schema);
    }
}
