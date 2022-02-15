<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200403133549 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->connection->executeQuery('INSERT INTO city (region_id, label, alias_key) SELECT region_id, \'Нижний Новгород\', \'Nizhnii Novgorod\' FROM region WHERE alias_key = \'CFD\'');
        $this->connection->executeQuery('INSERT INTO city (region_id, label, alias_key) SELECT region_id, \'Муром\', \'Murom\' FROM region WHERE alias_key = \'CFD\'');
        $this->connection->executeQuery('INSERT INTO city (region_id, label, alias_key) SELECT region_id, \'Ярославль\', \'Iaroslavl\' FROM region WHERE alias_key = \'CFD\'');
        $this->connection->executeQuery('INSERT INTO city (region_id, label, alias_key) SELECT region_id, \'Тверь\', \'Tver\' FROM region WHERE alias_key = \'CFD\'');
        $this->connection->executeQuery('INSERT INTO city (region_id, label, alias_key) SELECT region_id, \'Тамбов\', \'Tambov\' FROM region WHERE alias_key = \'CFD\'');
        $this->connection->executeQuery('INSERT INTO city (region_id, label, alias_key) SELECT region_id, \'Белгород\', \'Belgorod\' FROM region WHERE alias_key = \'CFD\'');
        $this->connection->executeQuery('INSERT INTO city (region_id, label, alias_key) SELECT region_id, \'Смоленск\', \'Smolensk\' FROM region WHERE alias_key = \'CFD\'');

        $this->connection->executeQuery('INSERT INTO city (region_id, label, alias_key) SELECT region_id, \'Псков\', \'Pskov\' FROM region WHERE alias_key = \'NWFD\'');

        $this->connection->executeQuery('INSERT INTO city (region_id, label, alias_key) SELECT region_id, \'Анапа\', \'Anapa\' FROM region WHERE alias_key = \'SFD\'');
        $this->connection->executeQuery('INSERT INTO city (region_id, label, alias_key) SELECT region_id, \'Армавир\', \'Armavir\' FROM region WHERE alias_key = \'SFD\'');
        $this->connection->executeQuery('INSERT INTO city (region_id, label, alias_key) SELECT region_id, \'Геленджик\', \'Gelendzhik\' FROM region WHERE alias_key = \'SFD\'');
        $this->connection->executeQuery('INSERT INTO city (region_id, label, alias_key) SELECT region_id, \'Майков\', \'Maikop\' FROM region WHERE alias_key = \'SFD\'');
        $this->connection->executeQuery('INSERT INTO city (region_id, label, alias_key) SELECT region_id, \'Новороссийск\', \'Novorossiisk\' FROM region WHERE alias_key = \'SFD\'');
        $this->connection->executeQuery('INSERT INTO city (region_id, label, alias_key) SELECT region_id, \'Ростов-на-Дону\', \'Rostov-na-Donu\' FROM region WHERE alias_key = \'SFD\'');
        $this->connection->executeQuery('INSERT INTO city (region_id, label, alias_key) SELECT region_id, \'Аксай\', \'Aksai\' FROM region WHERE alias_key = \'SFD\'');
        $this->connection->executeQuery('INSERT INTO city (region_id, label, alias_key) SELECT region_id, \'Симферополь\', \'Simferopol\' FROM region WHERE alias_key = \'SFD\'');
        $this->connection->executeQuery('INSERT INTO city (region_id, label, alias_key) SELECT region_id, \'Севастополь\', \'Sevastopol\' FROM region WHERE alias_key = \'SFD\'');
        $this->connection->executeQuery('INSERT INTO city (region_id, label, alias_key) SELECT region_id, \'Сочи\', \'Sochi\' FROM region WHERE alias_key = \'SFD\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
