<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 28.05.2019
 * Time: 22:22
 * Project: steellinevds
 */

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191226103034 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        if (!$schema->hasTable('error_report')) {
            $table = $schema->createTable('error_report');

            $table->addColumn('report_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('comment', 'text', ['notnull' => true]);
            $table->addColumn('chain', 'text', ['notnull' => true]);

            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('is_viewed', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);
            $table->addColumn('is_fixed', 'boolean', ['unsigned' => true, 'notnull' => true, 'default' => 0]);

            $table->setPrimaryKey(['report_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения отчётов об ошибках');

            $table->addIndex(['is_viewed'], 'is_viewed');
            $table->addIndex(['is_fixed'], 'is_fixed');
        }
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('error_report')) {
            $schema->dropTable('error_report');
        }
    }
}
