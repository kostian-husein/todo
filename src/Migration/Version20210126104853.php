<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210126104853 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('store')) {
            $table = $schema->getTable('store');

            if ( ! $table->hasColumn('city_id')) {
                $table->addColumn('city_id', 'integer', ['unsigned' => true, 'notnull' => false]);
                $table->addIndex(['city_id'], 'city_id');
                $table->addForeignKeyConstraint('city', ['city_id'], ['city_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_STORE_CITY');
            }
            if ( ! $table->hasColumn('region_id')) {
                $table->addColumn('region_id', 'integer', ['unsigned' => true, 'notnull' => false]);
                $table->addIndex(['region_id'], 'region_id');
                $table->addForeignKeyConstraint('region', ['region_id'], ['region_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_STORE_REGION');
            }
            if ( ! $table->hasColumn('country_id')) {
                $table->addColumn('country_id', 'integer', ['unsigned' => true, 'notnull' => false]);
                $table->addIndex(['country_id'], 'country_id');
                $table->addForeignKeyConstraint('country', ['country_id'], ['country_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_STORE_COUNTRY');
            }
        }
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('store')) {
            $table = $schema->getTable('store');

            if ($table->hasForeignKey('FK_STORE_CITY')) {
                $table->removeForeignKey('FK_STORE_CITY');
            }
            if ($table->hasColumn('city_id')) {
                $table->dropColumn('city_id');
            }
            if ($table->hasForeignKey('FK_STORE_REGION')) {
                $table->removeForeignKey('FK_STORE_REGION');
            }
            if ($table->hasColumn('region_id')) {
                $table->dropColumn('region_id');
            }
            if ($table->hasForeignKey('FK_STORE_COUNTRY')) {
                $table->removeForeignKey('FK_STORE_COUNTRY');
            }
            if ($table->hasColumn('country_id')) {
                $table->dropColumn('country_id');
            }
        }
    }
}
