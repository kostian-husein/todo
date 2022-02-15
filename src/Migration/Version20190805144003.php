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
final class Version20190805144003 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('parameter')) {
            $table = $schema->getTable('parameter');
            if (!$table->hasColumn('order_by')) {
                $table->addColumn('order_by', 'integer', ['unsigned' => true, 'notnull' => false]);
                $table->addIndex(['order_by'], 'order_by');
            }
        }
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('parameter')){
            $table = $schema->getTable('parameter');
            if ($table->hasColumn('order_by')) {
                $table->dropColumn('order_by');
            }
        }
    }
}
