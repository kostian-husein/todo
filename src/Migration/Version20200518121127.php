<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 18.05.2020
 * Time: 15:11
 * Project: vds
 */

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Change statistic table
 */
final class Version20200518121127 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription() : string
    {
        return 'Change statistic table';
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('statistic')) {
            $table = $schema->getTable('statistic');

            if ($table->hasColumn('url')) {
                $table->dropColumn('url');
            }

            if ($table->hasColumn('entry_time')) {
                $table->dropColumn('entry_time');
            }

            if (!$table->hasColumn('start_time')) {
                $table->addColumn('start_time', 'datetime', ['notnull' => true]);
            }

            if (!$table->hasColumn('finish_time')) {
                $table->addColumn('finish_time', 'datetime', ['notnull' => false, 'default' => null]);
            }

            if (!$table->hasColumn('requests_count')) {
                $table->addColumn('requests_count', 'integer', ['unsigned' => true, 'notnull' => false, 'default' => 0]);
            }

            if (!$table->hasColumn('user_id')) {
                $table->addColumn('user_id', 'integer', ['unsigned' => true, 'notnull' => true]);

                $table->addIndex(['user_id'], 'user_id');
                $table->addForeignKeyConstraint('user', ['user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_STATISTIC_USER_ID');
            }

            if (!$table->hasColumn('session_key')) {
                $table->addColumn('session_key', 'string', ['notnull' => true, 'length' => 32]);

                $table->addUniqueIndex(['session_key'], 'session_key');
            }
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\DBALException
     */
    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery('ALTER TABLE `statistic` MODIFY COLUMN `user_id` INT(10) UNSIGNED NOT NULL AFTER `statistic_id`');
        $this->connection->executeQuery('ALTER TABLE `statistic` MODIFY COLUMN `session_key` VARCHAR(32) NOT NULL AFTER `user_id`');
        $this->connection->executeQuery('ALTER TABLE `statistic` MODIFY COLUMN `ip` VARCHAR(20) NOT NULL AFTER `session_key`');
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('statistic')) {
            $table = $schema->getTable('statistic');

            if (!$table->hasColumn('url')) {
                $table->addColumn('url', 'string', ['notnull' => true, 'length' => 255]);
            }

            if (!$table->hasColumn('entry_time')) {
                $table->addColumn('url', 'string', ['notnull' => true, 'length' => 255]);
            }

            if ($table->hasColumn('start_time')) {
                $table->dropColumn('start_time');
            }

            if ($table->hasColumn('finish_time')) {
                $table->dropColumn('finish_time');
            }

            if ($table->hasForeignKey('FK_STATISTIC_USER_ID')) {
                $table->removeForeignKey('FK_STATISTIC_USER_ID');
            }

            if ($table->hasColumn('user_id')) {
                $table->dropColumn('user_id');
            }

            if ($table->hasColumn('session_key')) {
                $table->dropColumn('session_key');
            }

            if ($table->hasColumn('requests_count')) {
                $table->dropColumn('requests_count');
            }
        }
    }
}
