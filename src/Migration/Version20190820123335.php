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
final class Version20190820123335 extends AbstractMigration
{

    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('parameter')){
            $table = $schema->getTable('parameter');

            if (!$table->hasColumn('image')){
                $table->addColumn('image', 'string', ['notnull' => false, 'length' => 255, 'default' => null]);
            }
            if (!$table->hasColumn('image_real_filename')) {
                $table->addColumn('image_real_filename', 'string', ['notnull' => false, 'length' => 255]);
            }
            if (!$table->hasColumn('image_size')) {
                $table->addColumn('image_size', 'integer', ['unsigned' => true, 'notnull' => false]);
            }

            if (!$table->hasColumn('description')){
                $table->addColumn('description', 'string', ['notnull' => false, 'length' => 255]);
            }

            if (!$table->hasColumn('print_label')){
                $table->addColumn('print_label', 'string', ['notnull' => false, 'length' => 255]);
            }
        }

        if ($schema->hasTable('parameter_value')){
            $table = $schema->getTable('parameter_value');

            if (!$table->hasColumn('image')){
                $table->addColumn('image', 'string', ['notnull' => false, 'length' => 255, 'default' => null]);
            }
            if (!$table->hasColumn('image_real_filename')) {
                $table->addColumn('image_real_filename', 'string', ['notnull' => false, 'length' => 255]);
            }
            if (!$table->hasColumn('image_size')) {
                $table->addColumn('image_size', 'integer', ['unsigned' => true, 'notnull' => false]);
            }

            if (!$table->hasColumn('description')){
                $table->addColumn('description', 'string', ['notnull' => false, 'length' => 255]);
            }

            if (!$table->hasColumn('print_label')){
                $table->addColumn('print_label', 'string', ['notnull' => false, 'length' => 255]);
            }
        }
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('parameter')){
            $table = $schema->getTable('parameter');

            if ($table->hasColumn('image')){
                $table->dropColumn('image');
            }
            if ($table->hasColumn('image_real_filename')) {
                $table->dropColumn('image_real_filename');
            }
            if (!$table->hasColumn('image_size')) {
                $table->dropColumn('image_size');
            }

            if ($table->hasColumn('description')){
                $table->dropColumn('description');
            }

            if ($table->hasColumn('print_label')){
                $table->addColumn('print_label', 'string', ['notnull' => false, 'length' => 255]);
            }
        }

        if ($schema->hasTable('parameter_value')){
            $table = $schema->getTable('parameter_value');

            if ($table->hasColumn('image')){
                $table->dropColumn('image');
            }
            if ($table->hasColumn('image_real_filename')) {
                $table->dropColumn('image_real_filename');
            }
            if ($table->hasColumn('image_size')) {
                $table->dropColumn('image_size');
            }

            if ($table->hasColumn('description')){
                $table->dropColumn('description');
            }

            if ($table->hasColumn('print_label')){
                $table->addColumn('print_label', 'string', ['notnull' => false, 'length' => 255]);
            }
        }
    }
}
