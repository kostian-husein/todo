<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 31.08.2020
 * Time: 15:35
 * Project: vds
 */

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Create table(user_calculation) for user's calculations storing
 */
final class Version20200831123436 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription() : string
    {
        return 'Create table(user_calculation) for user\'s calculations storing';
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) : void
    {
        if (!$schema->hasTable('user_calculation')) {
            $table = $schema->createTable('user_calculation');
            $table->addColumn('calculation_id', 'integer', ['unsigned' => true, 'autoincrement' => true, 'notnull' => true]);
            $table->addColumn('user_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('label', 'string', ['notnull' => true, 'length' => 100]);
            $table->addColumn('data', 'json', ['notnull' => true]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);

            $table->setPrimaryKey(['calculation_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения рассчетов калькулятора');

            $table->addIndex(['user_id'], 'user_id');

            $table->addForeignKeyConstraint('user', ['user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_CALCULATION_USER');
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('user_calculation')) {
            $table = $schema->getTable('user_calculation');

            if ($table->hasForeignKey('FK_USER_CALCULATION_USER')) {
                $table->removeForeignKey('FK_USER_CALCULATION_USER');
            }

            $schema->dropTable('user_calculation');
        }
    }
}
