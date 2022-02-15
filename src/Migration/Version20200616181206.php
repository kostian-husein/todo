<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 19.06.2020
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
final class Version20200616181206 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        if (!$schema->hasTable('requisite')) {
            $table = $schema->createTable('requisite');

            $table->addColumn('requisite_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('label', 'string', ['length' => 255, 'notnull' => true]);
            $table->addColumn('bank_address', 'string', ['length' => 255, 'notnull' => true]);
            $table->addColumn('legal_address', 'string', ['length' => 255, 'notnull' => true]);
            $table->addColumn('payer_account_number', 'string', ['length' => 50, 'notnull' => true]);
            $table->addColumn('payment_account', 'string', ['length' => 50, 'notnull' => true]);
            $table->addColumn('bank_code', 'string', ['length' => 50, 'notnull' => true]);
            $table->addColumn('user_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);

            $table->setPrimaryKey(['requisite_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения записей о реквизитах');

            $table->addIndex(['user_id'], 'user_id');
            $table->addIndex(['last_user_id'], 'last_user_id');
            $table->addIndex(['is_active'], 'is_active');
            $table->addIndex(['is_deleted'], 'is_deleted');

            $table->addForeignKeyConstraint('user', ['user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_REQUISITE_USER');
            $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_LAST_USER_REQUISITE');
        }

        if (!$schema->hasTable('user_requisite')) {
            $table = $schema->createTable('user_requisite');

            $table->addColumn('id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('user_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('requisite_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);

            $table->setPrimaryKey(['id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения связей пользователя и торговых объектов');

            $table->addIndex(['user_id'], 'user_id');
            $table->addIndex(['requisite_id'], 'requisite_id');

            $table->addForeignKeyConstraint('requisite', ['requisite_id'], ['requisite_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_REQUISITE_REQUISITE');
            $table->addForeignKeyConstraint('user', ['user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_REQUISITE_USER');
        }
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('user_requisite')) {
            $table = $schema->getTable('user_requisite');

            $table->removeForeignKey('FK_USER_REQUISITE_REQUISITE');
            $table->removeForeignKey('FK_USER_REQUISITE_USER');
            $table->dropIndex('requisite_id');
            $table->dropIndex('user_id');

            $schema->dropTable('user_requisite');
        }

        if ($schema->hasTable('requisite')) {
            $table = $schema->getTable('requisite');

            $table->removeForeignKey('FK_REQUISITE_USER');
            $table->removeForeignKey('FK_LAST_USER_REQUISITE');
            $table->dropIndex('user_id');
            $table->dropIndex('last_user_id');

            $schema->dropTable('requisite');
        }
    }
}
