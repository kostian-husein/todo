<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 14.10.2021
 * Time: 14:20
 * Project: steelline
 */

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Remove is_sample and main_order_sample columns from client_order table
 */
final class Version20211014114545 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription() : string
    {
        return 'Remove is_sample and main_order_sample columns from client_order table';
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('client_order')) {
            $table = $schema->getTable('client_order');

            if ($table->hasColumn('is_sample')) {
                $table->dropColumn('is_sample');
            }

            if ($table->hasColumn('main_order_sample')) {
                $table->dropColumn('main_order_sample');
            }
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('client_order')) {
            $table = $schema->getTable('client_order');

            if (!$table->hasColumn('is_sample')) {
                $table->addColumn('is_sample', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            }

            if ($table->hasColumn('main_order_sample')) {
                $table->addColumn('main_order_sample', 'string', ['notnull' => false]);
            }
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Exception
     */
    public function postDown(Schema $schema): void
    {
        $this->connection->executeQuery("ALTER TABLE `client_order` MODIFY `main_order_sample` ENUM('scheduled_replacement', 'opening_new_shop', 'upgrade_status_shop', 'replacement_for_black_friday') NULL;");
    }
}
