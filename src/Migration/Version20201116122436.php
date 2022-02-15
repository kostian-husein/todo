<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201116122436 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('parameter_price')) {
            $table = $schema->getTable('parameter_price');

            $table->addColumn('company_id', 'integer', ['unsigned' => true, 'notnull' => true, 'default' => 1]);

            $table->addIndex(['company_id'], 'company_id');
            $table->addUniqueIndex(['parameter_price_id', 'company_id'], 'uniq_parameter_price_id_company_id');

            $table->addForeignKeyConstraint('company', ['company_id'], ['company_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_PARAMETER_PRICE_COMPANY');
        }
    }

    public function down(Schema $schema) : void
    {
        if ( $schema->hasTable('parameter_price')) {
            $table = $schema->getTable('parameter_price');

            if ($table->hasForeignKey('FK_PARAMETER_PRICE_COMPANY')) {
                $table->removeForeignKey('FK_PARAMETER_PRICE_COMPANY');
            }

            $table->dropColumn('company_id');
        }
    }
}
