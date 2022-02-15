<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 22.06.2020
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
final class Version20200618064010 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        if (! $schema->hasTable('password_reset_request')) {
            $table = $schema->createTable('password_reset_request');

            $table->addColumn('request_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('user_id', 'integer', ['unsigned' => true, 'notnull' => false, 'default' => null]);
            $table->addColumn('hash', 'string', ['notnull' => true, 'length' => 50]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);

            $table->setPrimaryKey(['request_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения запросов на сброс пароля');

            $table->addUniqueIndex(['hash'], 'hash');

            $table->addForeignKeyConstraint('user', ['user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_PASSWORD_REQUEST_RESET');
        }

    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('password_reset_request')) {
            $table = $schema->getTable('password_reset_request');

            if ($table->hasForeignKey('FK_USER_PASSWORD_REQUEST_RESET')) {
                $table->removeForeignKey('FK_USER_PASSWORD_REQUEST_RESET');
            }

            $schema->dropTable('password_reset_request');
        }
    }
}
