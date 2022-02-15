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
 * Add company and user_company tables
 */
final class Version20201014064416 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription() : string
    {
        return 'Add company and user_company tables';
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('user')) {
            $table = $schema->getTable('user');

            if ($table->hasColumn('company')) {
                $table->dropColumn('company');
            }
        }

        if (!$schema->hasTable('company')) {
            $table = $schema->createTable('company');

            $table->addColumn('company_id', 'integer', ['autoincrement' => true, 'unsigned' => true, 'notnull' => true]);
            $table->addColumn('label', 'string', ['notnull' => true, 'length' => 50]);
            $table->addColumn('alias', 'string', ['notnull' => true, 'length' => 50]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);
            $table->addColumn('is_deleted', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => true]);

            $table->setPrimaryKey(['company_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения компаний, к которым может принадлежать пользователь');

            $table->addIndex(['is_active'], 'is_active');
            $table->addIndex(['is_deleted'], 'is_deleted');
            $table->addIndex(['last_user_id'], 'last_user_id');

            $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_COMPANY_LAST_USER_ID');
        }

        if (!$schema->hasTable('user_company')) {
            $table = $schema->createTable('user_company');

            $table->addColumn('id', 'integer', ['autoincrement' => true, 'unsigned' => true, 'notnull' => true]);
            $table->addColumn('user_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('company_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);

            $table->setPrimaryKey(['id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения связей пользователь-компания');

            $table->addIndex(['user_id'], 'user_id');
            $table->addIndex(['company_id'], 'company_id');
            $table->addUniqueIndex(['user_id', 'company_id'], 'uniq_user_id_company_id');

            $table->addForeignKeyConstraint('user', ['user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_COMPANY_USER_ID');
            $table->addForeignKeyConstraint('company', ['company_id'], ['company_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_COMPANY_COMPANY_ID');
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\DBALException
     */
    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery('INSERT INTO company(label, alias, last_user_id) VALUES ("Стальная Линия", "steelline", 1), ("Солнечная компания", "sun", 1)');

        $stmt = $this->connection->executeQuery('SELECT user_id FROM user');
        $users = $stmt->fetchAll();

        $values = [];
        foreach ($users as $user) {
            $values[] = "({$user['user_id']}, 1)";
        }

        $this->connection->executeQuery('INSERT INTO user_company(user_id, company_id) VALUES ' . implode(',', $values));
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('user_company')) {
            $table = $schema->getTable('user_company');

            if ($table->hasForeignKey('FK_USER_COMPANY_USER_ID')) {
                $table->removeForeignKey('FK_USER_COMPANY_USER_ID');
            }

            if ($table->hasForeignKey('FK_USER_COMPANY_COMPANY_ID')) {
                $table->removeForeignKey('FK_USER_COMPANY_COMPANY_ID');
            }

            $schema->dropTable('user_company');
        }

        if ($schema->hasTable('company')) {
            $table = $schema->getTable('company');

            if ($table->hasForeignKey('FK_COMPANY_LAST_USER_ID')) {
                $table->removeForeignKey('FK_COMPANY_LAST_USER_ID');
            }

            $schema->dropTable('company');
        }

        if ($schema->hasTable('user')) {
            $table = $schema->getTable('user');

            if (!$table->hasColumn('company')) {
                $table->addColumn('company', 'string');
            }
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\DBALException
     */
    public function postDown(Schema $schema): void
    {
        $this->connection->executeQuery('UPDATE `user` SET `company` = "steelline"');
        $this->connection->executeQuery('ALTER TABLE `user` MODIFY `company` ENUM("steelline", "sun") NOT NULL DEFAULT "steelline"');
    }
}
