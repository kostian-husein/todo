<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 29.07.2021
 * Time: 12:22
 * Project: vds
 */

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Add new permission ROLE_CAN_CREATE_EXPRESS_ORDER
 */
final class Version20210729093656 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription() : string
    {
        return 'Add new permission ROLE_CAN_CREATE_EXPRESS_ORDER';
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('client_order')) {
            $table = $schema->getTable('client_order');

            if (!$table->hasColumn('is_express')) {
                $table->addColumn('is_express', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
                $table->addIndex(['is_express'], 'is_express');
            }
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Exception
     */
    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery("INSERT INTO `permission` (`last_user_id`, `label`, `code`) VALUE (1, 'Создание экспресс заказа', 'ROLE_CAN_CREATE_EXPRESS_ORDER')");
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('client_order')) {
            $table = $schema->getTable('client_order');

            if ($table->hasColumn('is_express')) {
                $table->dropColumn('is_express');
            }
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Exception
     */
    public function postDown(Schema $schema): void
    {
        $this->connection->executeQuery("DELETE FROM `permission` WHERE `code` = 'ROLE_CAN_CREATE_EXPRESS_ORDER'");
    }
}
