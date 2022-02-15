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

final class Version20191127093853 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        if (!$schema->hasTable('statistic')) {
            $table = $schema->createTable('statistic');

            $table->addColumn('statistic_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('ip', 'string', ['notnull' => true, 'length' => 255]);
            $table->addColumn('user_agent', 'string', ['notnull' => true, 'length' => 255]);
            $table->addColumn('entry_time', 'datetime', ['notnull' => true]);
            $table->addColumn('url', 'string', ['notnull' => true, 'length' => 255]);

            $table->setPrimaryKey(['statistic_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения статистики по калькулятору');
        }
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('statistic')) {
            $schema->dropTable('statistic');
        }
    }
}
