<?php
/**
 * Created by PhpStorm.
 * User: Denis
 * Date: 31.01.2020
 * Time: 13:32
 * Project: steellinevds
 */

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20200131103055 extends AbstractMigration
{

    public function up(Schema $schema) : void
    {

    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\DBALException
     */
    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery('INSERT INTO city (region_id, label, alias_key) SELECT region_id, \'Москва\', \'Moscow\' FROM region WHERE alias_key = \'CFD\'');
        $this->connection->executeQuery('INSERT INTO city (region_id, label, alias_key) SELECT region_id, \'Брянск\', \'Bryansk\' FROM region WHERE alias_key = \'CFD\'');
        $this->connection->executeQuery('INSERT INTO city (region_id, label, alias_key) SELECT region_id, \'Калуга\', \'Kaluga\' FROM region WHERE alias_key = \'CFD\'');
        $this->connection->executeQuery('INSERT INTO city (region_id, label, alias_key) SELECT region_id, \'Курск\', \'Kursk\' FROM region WHERE alias_key = \'CFD\'');
        $this->connection->executeQuery('INSERT INTO city (region_id, label, alias_key) SELECT region_id, \'Липецк\', \'Lipetsk\' FROM region WHERE alias_key = \'CFD\'');
        $this->connection->executeQuery('INSERT INTO city (region_id, label, alias_key) SELECT region_id, \'Орёл\', \'Orel\' FROM region WHERE alias_key = \'CFD\'');
        $this->connection->executeQuery('INSERT INTO city (region_id, label, alias_key) SELECT region_id, \'Тула\', \'Tula\' FROM region WHERE alias_key = \'CFD\'');
        $this->connection->executeQuery('INSERT INTO city (region_id, label, alias_key) SELECT region_id, \'Санкт-петербург\', \'St. Petersburg\' FROM region WHERE alias_key = \'NWFD\'');
        $this->connection->executeQuery('INSERT INTO city (region_id, label, alias_key) SELECT region_id, \'Калининград\', \'Kaliningrad\' FROM region WHERE alias_key = \'NWFD\'');
        $this->connection->executeQuery('INSERT INTO city (region_id, label, alias_key) SELECT region_id, \'Краснодар\', \'Krasnodar\' FROM region WHERE alias_key = \'SFD\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
