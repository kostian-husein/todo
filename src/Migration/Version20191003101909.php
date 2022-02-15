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
final class Version20191003101909 extends AbstractMigration
{

    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('product_type_parameter')){
            $table = $schema->getTable('product_type_parameter');

            if (!$table->hasColumn('is_visible')){
                $table->addColumn('is_visible', 'boolean', ['unsigned' => true, 'notnull' => true]);
            }
        }
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('product_type_parameter')){
            $table = $schema->getTable('product_type_parameter');

            if ($table->hasColumn('is_visible')){
                $table->dropColumn('is_visible');
            }
        }
    }
}
