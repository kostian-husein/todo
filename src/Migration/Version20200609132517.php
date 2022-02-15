<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 16.06.2020
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
final class Version20200609132517 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        if (!$schema->hasTable('user_store')) {
            $table = $schema->createTable('user_store');

            $table->addColumn('id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('user_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('store_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);

            $table->setPrimaryKey(['id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения связей пользователя и торговых объектов');

            $table->addIndex(['user_id'], 'user_id');
            $table->addIndex(['store_id'], 'store_id');

            $table->addForeignKeyConstraint('store', ['store_id'], ['store_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_STORE');
            $table->addForeignKeyConstraint('user', ['user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_STORE_USER');
        }
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('user_store')) {
            $table = $schema->getTable('user_store');

            $table->removeForeignKey('FK_USER_STORE');
            $table->removeForeignKey('FK_STORE_USER');
            $table->dropIndex('store_id');
            $table->dropIndex('user_id');

            $schema->dropTable('user_store');
        }
    }
}
