<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 23.06.2020
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
final class Version20200622090807 extends AbstractMigration
{
    public static $tables = ['city', 'region', 'country', 'parameter', 'product_type_parameter', 'parameter_value', 'error_report'];

    public function up(Schema $schema) : void
    {
        foreach (self::$tables as $tableName) {
            $table = $schema->getTable($tableName);

            if (!$table->hasColumn('is_active')) {
                $table->addColumn('is_active', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 1]);
                $table->addIndex(['is_active'], 'is_active');
            }

            if (!$table->hasColumn('last_user_id')) {
                $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => false, 'default' => null]);
                $table->addIndex(['last_user_id'], 'last_user_id');
                $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_' . mb_strtoupper($tableName) . '_LAST_USER');
            }
        }
    }

    public function down(Schema $schema) : void
    {
        foreach (self::$tables as $tableName) {
            $table = $schema->getTable($tableName);

            if ($table->hasColumn('is_active')) {
                if ($table->hasIndex('is_active')) {
                    $table->dropIndex('is_active');
                }
                $table->dropColumn('is_active');
            }

            if ($table->hasColumn('last_user_id')) {
                $table->removeForeignKey('FK_' . mb_strtoupper($tableName) . '_LAST_USER');
                if ($table->hasIndex('last_user_id')) {
                    $table->dropIndex('last_user_id');
                }
                $table->dropColumn('last_user_id');
            }
        }
    }
}
