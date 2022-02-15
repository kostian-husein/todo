<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 14.10.2020
 * Time: 09:49
 * Project: steellinevds
 */

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Add company_id columns
 */
final class Version20201014064417 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription() : string
    {
        return 'Add company_id columns';
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('user_calculation')) {
            $table = $schema->getTable('user_calculation');

            if (!$table->hasColumn('company_id')) {
                $table->addColumn('company_id', 'integer', ['unsigned' => true, 'notnull' => true, 'default' => 1]);
                $table->addIndex(['company_id'], 'company_id');
                $table->addForeignKeyConstraint('company', ['company_id'], ['company_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_CALCULATION_COMPANY_ID');
            }
        }

        if ($schema->hasTable('error_report')) {
            $table = $schema->getTable('error_report');

            if (!$table->hasColumn('company_id')) {
                $table->addColumn('company_id', 'integer', ['unsigned' => true, 'notnull' => true, 'default' => 1]);
                $table->addIndex(['company_id'], 'company_id');
                $table->addForeignKeyConstraint('company', ['company_id'], ['company_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_ERROR_REPORT_COMPANY_ID');
            }
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('user_calculation')) {
            $table = $schema->getTable('user_calculation');

            if ($table->hasForeignKey('FK_USER_CALCULATION_COMPANY_ID')) {
                $table->removeForeignKey('FK_USER_CALCULATION_COMPANY_ID');
            }

            if ($table->hasColumn('company_id')) {
                $table->dropColumn('company_id');
            }
        }

        if ($schema->hasTable('error_report')) {
            $table = $schema->getTable('error_report');

            if ($table->hasForeignKey('FK_ERROR_REPORT_COMPANY_ID')) {
                $table->removeForeignKey('FK_ERROR_REPORT_COMPANY_ID');
            }

            if ($table->hasColumn('company_id')) {
                $table->dropColumn('company_id');
            }
        }
    }
}
