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
final class Version20191007105354 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('country')){
            $table = $schema->getTable('country');

            if (!$table->hasColumn('alias_key')){
                $table->addColumn('alias_key', 'string', ['notnull' => true, 'unique' => true]);
            }
        }
    }

    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery("INSERT INTO country (label, exchange_rate, currency, alias_key) VALUES ('Республика Беларусь', 2.14, 'BYN', 'Belarus')");
        $this->connection->executeQuery("INSERT INTO country (label, exchange_rate, currency, alias_key) VALUES ('Российская Федерация', 66.7, 'RUB', 'Russia')");
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('country')){
            $table = $schema->getTable('country');

            if ($table->hasColumn('alias_key')){
                $table->dropColumn('alias_key');
            }
        }
    }
}
