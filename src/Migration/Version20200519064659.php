<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 19.05.2020
 * Time: 09:11
 * Project: vds
 */

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Rename statistic table and add new columns
 */
final class Version20200519064659 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription() : string
    {
        return 'Rename statistic table and add new columns';
    }

    /**
     * @param Schema $schema
     */
    public function preUp(Schema $schema): void
    {
        try {
            $this->connection->executeQuery('RENAME TABLE `statistic` TO `calculator_statistic`');
        } catch (\Exception $ex) {
            //
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('calculator_statistic')) {
            $table = $schema->getTable('calculator_statistic');

            if (!$table->hasColumn('form_type')) {
                $table->addColumn('form_type', 'string');
                $table->addIndex(['form_type'], 'form_type');
            }

            if (!$table->hasColumn('product_type')) {
                $table->addColumn('product_type', 'string');
                $table->addIndex(['product_type'], 'product_type');
            }

            if (!$table->hasColumn('usage_time')) {
                $table->addColumn('usage_time', 'integer', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            }
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\DBALException
     */
    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery('TRUNCATE TABLE `calculator_statistic`');
        $this->connection->executeQuery('ALTER TABLE `calculator_statistic` MODIFY form_type ENUM("catalog", "individual") NOT NULL');
        $this->connection->executeQuery('ALTER TABLE `calculator_statistic` MODIFY product_type ENUM("metal-door", "street-door") NOT NULL');
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('calculator_statistic')) {
            $table = $schema->getTable('calculator_statistic');

            if ($table->hasColumn('form_type')) {
                $table->dropColumn('form_type');
            }

            if ($table->hasColumn('product_type')) {
                $table->dropColumn('product_type');
            }

            if ($table->hasColumn('usage_time')) {
                $table->dropColumn('usage_time');
            }
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\DBALException
     */
    public function postDown(Schema $schema): void
    {
        $this->connection->executeQuery('RENAME TABLE `calculator_statistic` TO `statistic`');
    }
}
