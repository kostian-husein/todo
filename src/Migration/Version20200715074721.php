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
 * Add uploads_count column to calculator_statistic table
 */
final class Version20200715074721 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription() : string
    {
        return 'Add uploads_count column to calculator_statistic table';
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('calculator_statistic')) {
            $table = $schema->getTable('calculator_statistic');

            if (!$table->hasColumn('uploads_count')) {
                $table->addColumn('uploads_count', 'smallint', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            }
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('calculator_statistic')) {
            $table = $schema->getTable('calculator_statistic');

            if ($table->hasColumn('uploads_count')) {
                $table->dropColumn('uploads_count');
            }
        }
    }
}
