<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 05.03.2020
 * Time: 13:45
 * Project: steellinevds
 */

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Add user_id column to error_report column
 *
 * Class Version20200305103818
 * @package Application\Migration
 */
final class Version20200305103818 extends AbstractMigration
{
    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('error_report')) {
            $table = $schema->getTable('error_report');

            if (! $table->hasColumn('user_id')) {
                $table->addColumn('user_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            }

            if (! $table->hasIndex('user_id')) {
                $table->addIndex(['user_id'], 'user_id');
            }
        }
    }

    /**
     * @param Schema $schema
     */
    public function postUp(Schema $schema): void
    {
        try {
            $this->connection->executeQuery("UPDATE error_report SET user_id = (SELECT user_id FROM user WHERE email = 'manager@steelline.by') WHERE user_id = 0");
        } catch (\Exception $ex) {
            //
        }

        try {
            $this->connection->executeQuery("ALTER TABLE error_report ADD CONSTRAINT FK_ERROR_REPORT_USER FOREIGN KEY (user_id) REFERENCES user(user_id)");
        } catch (\Exception $ex) {
            //
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('error_report')) {
            $table = $schema->getTable('error_report');

            if ($table->hasForeignKey('FK_ERROR_REPORT_USER')) {
                $table->removeForeignKey('FK_ERROR_REPORT_USER');
            }

            if ($table->hasColumn('user_id')) {
                $table->dropColumn('user_id');
            }
        }
    }
}
