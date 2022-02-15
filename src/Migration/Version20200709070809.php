<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 10.07.2020
 * Time: 09:27
 * Project: vds
 */

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Create calculator_version table and make last_user_id nullable
 */
final class Version20200709070809 extends AbstractMigration
{
    private const TABLES = [
        'attendant_parameter',
        'city',
        'city_coefficient',
        'client',
        'coefficient_to_base',
        'country',
        'country_coefficient',
        'country_extra_charge',
        'error_report',
        'parameter',
        'parameter_condition',
        'parameter_dependencies',
        'parameter_dimension',
        'parameter_mandatory_condition',
        'parameter_price',
        'parameter_value',
        'permission',
        'price_for_dimension',
        'product_type',
        'product_type_parameter',
        'region',
        'region_coefficient',
        'requisite',
        'role',
        'store',
        'store_contact',
        'user',
    ];

    /**
     * @return string
     */
    public function getDescription() : string
    {
        return 'Create calculator_version table and make last_user_id nullable';
    }

    /**
     * @param Schema $schema
     */
    public function preUp(Schema $schema): void
    {
        foreach (self::TABLES as $tableName) {
            try {
                $this->connection->executeQuery("ALTER TABLE {$tableName} MODIFY `last_user_id` INT(10) UNSIGNED NULL DEFAULT NULL");
            } catch (\Exception $ex) {
                //
            }
        }
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) : void
    {
        if (!$schema->hasTable('calculator_version')) {
            $table = $schema->createTable('calculator_version');
            $table->addColumn('id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('version', 'string', ['length' => 20, 'notnull' => true]);
            $table->addColumn('description', 'text', ['notnull' => true]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => false, 'default' => null]);

            $table->setPrimaryKey(['id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения записей об обновлении калькулятора');

            $table->addIndex(['last_user_id'], 'last_user_id');
            $table->addUniqueIndex(['version'], 'version');
            $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_CALCULATOR_UPDATE_LAST_USER');
        }
    }

    /**
     * @param Schema $schema
     */
    public function preDown(Schema $schema): void
    {
        foreach (self::TABLES as $tableName) {
            try {
                $this->connection->executeQuery("ALTER TABLE {$tableName} MODIFY `last_user_id` INT(10) UNSIGNED NOT NULL DEFAULT 1");
            } catch (\Exception $ex) {
                //
            }
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('calculator_version')) {
            $table = $schema->getTable('calculator_version');
            if ($table->hasForeignKey('FK_CALCULATOR_UPDATE_LAST_USER')) {
                $table->removeForeignKey('FK_CALCULATOR_UPDATE_LAST_USER');
            }

            $schema->dropTable('calculator_version');
        }
    }
}
