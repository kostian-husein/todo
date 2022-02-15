<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 09.06.2020
 * Time: 09:27
 * Project: vds
 */

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200529131247 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        if (!$schema->hasTable('store')) {
            $table = $schema->createTable('store');

            $table->addColumn('store_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('label', 'string', ['length' => 255, 'notnull' => true]);
            $table->addColumn('address', 'string', ['length' => 255, 'notnull' => true]);
            $table->addColumn('type', 'string', ['notnull' => true]);
            $table->addColumn('owner_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);

            $table->setPrimaryKey(['store_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения записей о торговых объектах');

            $table->addIndex(['owner_id'], 'owner_id');
            $table->addIndex(['last_user_id'], 'last_user_id');
            $table->addIndex(['is_active'], 'is_active');
            $table->addIndex(['is_deleted'], 'is_deleted');

            $table->addForeignKeyConstraint('user', ['owner_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_OWNER_STORE');
            $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_LAST_USER_STORE');
        }

        if (!$schema->hasTable('store_contact')) {
            $table = $schema->createTable('store_contact');

            $table->addColumn('contact_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('store_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('type', 'string', ['notnull' => true]);
            $table->addColumn('value', 'string', ['length' => 255, 'notnull' => true]);
            $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);

            $table->setPrimaryKey(['contact_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения записей о контактах торговых объектов');

            $table->addIndex(['store_id'], 'store_id');
            $table->addIndex(['last_user_id'], 'last_user_id');
            $table->addIndex(['is_deleted'], 'is_deleted');

            $table->addForeignKeyConstraint('store', ['store_id'], ['store_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_STORE_CONTACT');
            $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_LAST_USER_STORE_CONTACT');
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\DBALException
     */
    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery("ALTER TABLE `store` MODIFY `type` ENUM('brand_store', 'brand_section', 'monobrand_store') NOT NULL DEFAULT 'brand_store';");
        $this->connection->executeQuery("ALTER TABLE `store_contact` MODIFY `type` ENUM('phone', 'site', 'email') NOT NULL;");
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('store_contact')) {
            $table = $schema->getTable('store_contact');

            $table->removeForeignKey('FK_STORE_CONTACT');
            $table->removeForeignKey('FK_LAST_USER_STORE_CONTACT');
            $table->dropIndex('store_id');
            $table->dropIndex('last_user_id');

            $schema->dropTable('store_contact');
        }

        if ($schema->hasTable('store')) {
            $table = $schema->getTable('store');

            $table->removeForeignKey('FK_OWNER_STORE');
            $table->removeForeignKey('FK_LAST_USER_STORE');
            $table->dropIndex('owner_id');
            $table->dropIndex('last_user_id');

            $schema->dropTable('store');
        }
    }
}
