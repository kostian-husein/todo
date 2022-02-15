<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 25.06.2020
 * Time: 09:27
 * Project: vds
 */

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200625064750 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {

    }

    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery("INSERT INTO country (label, exchange_rate, currency, alias_key) VALUES ('Узбекистан', 1.0, 'USD', 'Uzbekistan')");
        $this->connection->executeQuery("INSERT INTO country (label, exchange_rate, currency, alias_key) VALUES ('Молдова', 1.0, 'USD', 'Moldova')");
    }

    public function down(Schema $schema) : void
    {

    }
}
