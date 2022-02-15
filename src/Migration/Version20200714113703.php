<?php
/**
 * Created by PhpStorm.
 * User: Dinis
 * Date: 14.07.2020
 * Time: 13:27
 * Project: vds
 */

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Add Lithuania to countries list
 */
final class Version20200714113703 extends AbstractMigration
{

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) : void
    {

    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\DBALException
     */
    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery("INSERT INTO country (label, exchange_rate, currency, alias_key) VALUES ('Литва', 1.0, 'USD', 'Lithuania')");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
