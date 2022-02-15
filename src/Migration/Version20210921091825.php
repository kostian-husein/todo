<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 21.09.2021
 * Time: 12:20
 * Project: steelline
 */

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Add alias column to product_type table
 */
final class Version20210921091825 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription() : string
    {
        return 'Add alias column to product_type table';
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('product_type')) {
            $table = $schema->getTable('product_type');

            if (!$table->hasColumn('alias')) {
                $table->addColumn('alias', 'string', ['notnull' => true, 'length' => 20]);
            }
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Exception
     */
    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery('
            UPDATE `product_type` SET `alias` = CASE short_label
              WHEN "ПМ" THEN "threshold"
              WHEN "КО" THEN "escarpment"
              WHEN "МП" THEN "mountingPlates"
              WHEN "КФ" THEN "accessories"
              WHEN "ДУ" THEN "street-door"
              WHEN "УГ" THEN "angle"
              WHEN "Вм" THEN "metal-gates"
              WHEN "М" THEN "metalwork"
              WHEN "Вз" THEN "reclamation"
              WHEN "ИД" THEN "product-d-o"
              WHEN "ДМ" THEN "metal-door"
              WHEN "УПр" THEN "services"
              WHEN "Р" THEN "lattice"
              WHEN "Рм" THEN "repair"
              WHEN "ПП" THEN "otherProducts"
              WHEN "П" THEN "rework"
              WHEN "ОР" THEN "doubleGlazedWindow"
              WHEN "НД" THEN "dobor"
              WHEN "ПСН" THEN "product-own-need"
              WHEN "ДДК" THEN "combinedDoorsDobors"
              WHEN "СПр" THEN "own-production"
              WHEN "ЩН" THEN "shields"
              WHEN "ОДК" THEN "frame-combined-doors"
              WHEN "ФН" THEN "implement"
              ELSE `alias`
              END
              WHERE short_label IN("ПМ", "КО", "МП", "КФ", "ДУ", "УГ", "Вм", "М", "Вз", "ИД", "ДМ", "УПр", "Р", "Рм", "ПП", "П", "ОР", "НД", "ПСН", "ДДК", "СПр", "ЩН", "ОДК", "ФН");
        ');
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('product_type')) {
            $table = $schema->getTable('product_type');

            if ($table->hasColumn('alias')) {
                $table->dropColumn('alias');
            }
        }
    }
}
