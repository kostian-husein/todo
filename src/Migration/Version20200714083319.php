<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200714083319 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        if (! $schema->hasTable('milling_image')) {
            $table = $schema->createTable('milling_image');

            $table->addColumn('image_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('parameter_value_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('side', 'string', ['notnull' => true]);
            $table->addColumn('image', 'string', ['notnull' => true, 'length' => 255]);
            $table->addColumn('image_real_filename', 'string', ['notnull' => true, 'length' => 255]);
            $table->addColumn('image_size', 'integer', ['unsigned' => true, 'notnull' => false]);
            $table->addColumn('image_extension', 'string', ['notnull' => true, 'length' => 10]);

            $table->setPrimaryKey(['image_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Таблица для хранения изображений параметров');

            $table->addIndex(['parameter_value_id'], 'parameter_value_id');
            $table->addUniqueIndex(['parameter_value_id', 'side'], 'uniq_parameter_value_side_image');

            $table->addForeignKeyConstraint('parameter_value', ['parameter_value_id'], ['value_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_PARAMETER_IMAGE_PARAMETER_VALUE');
        }
    }

    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery('ALTER TABLE milling_image MODIFY side ENUM("left", "right") NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('milling_image')) {
            $table = $schema->getTable('milling_image');

            if ($table->hasForeignKey('FK_PARAMETER_IMAGES_PARAMETER_VALUE')) {
                $table->removeForeignKey('FK_PARAMETER_IMAGES_PARAMETER_VALUE');
            }

            $schema->dropTable('milling_image');
        }
    }
}
