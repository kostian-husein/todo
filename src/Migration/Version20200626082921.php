<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 26.06.2020
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
final class Version20200626082921 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) : void
    {
        if (! $schema->hasTable('client')) {
            $table = $schema->createTable('client');

            $table->addColumn('client_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('email', 'string', ['notnull' => false, 'length' => 255]);
            $table->addColumn('phone', 'string', ['notnull' => true, 'length' => 20]);
            $table->addColumn('first_name', 'string', ['notnull' => true, 'length' => 25]);
            $table->addColumn('last_name', 'string', ['notnull' => true, 'length' => 25]);
            $table->addColumn('patronymic', 'string', ['notnull' => true, 'length' => 25]);
            $table->addColumn('date_of_birth', 'datetime', ['notnull' => false, 'default' => null]);
            $table->addColumn('address', 'json', ['notnull' => true]);
            $table->addColumn('passport_id', 'string', ['notnull' => false, 'length' => 20]);

            $table->addColumn('country_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('region_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('city_id', 'integer', ['unsigned' => true, 'notnull' => true]);


            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => false, 'default' => null]);

            $table->setPrimaryKey(['client_id']);

            $table->addUniqueIndex(['email'], 'email');
            $table->addUniqueIndex(['phone'], 'phone');
            $table->addUniqueIndex(['passport_id'], 'passport_id');

            $table->addIndex(['country_id'], 'country_id');
            $table->addIndex(['region_id'], 'region_id');
            $table->addIndex(['city_id'], 'city_id');
            $table->addIndex(['last_user_id'], 'last_user_id');

            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения данных клиента');

            $table->addForeignKeyConstraint('country', ['country_id'], ['country_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_COUNTRY_CLIENT');
            $table->addForeignKeyConstraint('region', ['region_id'], ['region_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_REGION_CLIENT');
            $table->addForeignKeyConstraint('city', ['city_id'], ['city_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_CITY_CLIENT');
            $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_CLIENT');
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('client')) {
            $table = $schema->getTable('client');

            if ($table->hasForeignKey('FK_COUNTRY_CLIENT')) {
                $table->removeForeignKey('FK_COUNTRY_CLIENT');
            }

            if ($table->hasForeignKey('FK_REGION_CLIENT')) {
                $table->removeForeignKey('FK_REGION_CLIENT');
            }

            if ($table->hasForeignKey('FK_CITY_CLIENT')) {
                $table->removeForeignKey('FK_CITY_CLIENT');
            }

            if ($table->hasForeignKey('FK_USER_CLIENT')) {
                $table->removeForeignKey('FK_USER_CLIENT');
            }

            $schema->dropTable('client');
        }
    }
}
