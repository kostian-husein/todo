<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201119062931 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {

    }

    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery("INSERT INTO region (country_id, label, alias_key) VALUES (1, 'Минская', 'Minskaya')");
        $this->connection->executeQuery("INSERT INTO region (country_id, label, alias_key) VALUES (1, 'Могилёвская', 'Mogilevskaya')");
        $this->connection->executeQuery("INSERT INTO region (country_id, label, alias_key) VALUES (1, 'Витебская', 'Vitebskaya')");
        $this->connection->executeQuery("INSERT INTO region (country_id, label, alias_key) VALUES (1, 'Гродненская', 'Grodneskaya')");
        $this->connection->executeQuery("INSERT INTO region (country_id, label, alias_key) VALUES (1, 'Гомельская', 'Gomelskaya')");
        $this->connection->executeQuery("INSERT INTO region (country_id, label, alias_key) VALUES (1, 'Брестская', 'Brestskaya')");

        $this->connection->executeQuery("INSERT INTO city (region_id, label, alias_key) VALUES ((SELECT region.region_id FROM region WHERE region.alias_key = 'Minskaya'), 'Борисов', 'Borisov')");
        $this->connection->executeQuery("INSERT INTO city (region_id, label, alias_key) VALUES ((SELECT region.region_id FROM region WHERE region.alias_key = 'Minskaya'), 'Минск', 'Minsk')");
        $this->connection->executeQuery("INSERT INTO city (region_id, label, alias_key) VALUES ((SELECT region.region_id FROM region WHERE region.alias_key = 'Minskaya'), 'Солигорск', 'Soligorsk')");

        $this->connection->executeQuery("INSERT INTO city (region_id, label, alias_key) VALUES ((SELECT region.region_id FROM region WHERE region.alias_key = 'Mogilevskaya'), 'Могилёв', 'Mogilev')");
        $this->connection->executeQuery("INSERT INTO city (region_id, label, alias_key) VALUES ((SELECT region.region_id FROM region WHERE region.alias_key = 'Mogilevskaya'), 'Бобруйск', 'Bobruisk')");

        $this->connection->executeQuery("INSERT INTO city (region_id, label, alias_key) VALUES ((SELECT region.region_id FROM region WHERE region.alias_key = 'Brestskaya'), 'Пинск', 'Pinsk')");
        $this->connection->executeQuery("INSERT INTO city (region_id, label, alias_key) VALUES ((SELECT region.region_id FROM region WHERE region.alias_key = 'Brestskaya'), 'Брест', 'Brest')");
        $this->connection->executeQuery("INSERT INTO city (region_id, label, alias_key) VALUES ((SELECT region.region_id FROM region WHERE region.alias_key = 'Brestskaya'), 'Барановичи', 'Baranovichi')");
        $this->connection->executeQuery("INSERT INTO city (region_id, label, alias_key) VALUES ((SELECT region.region_id FROM region WHERE region.alias_key = 'Brestskaya'), 'Кобрин', 'Kobrin')");

        $this->connection->executeQuery("INSERT INTO city (region_id, label, alias_key) VALUES ((SELECT region.region_id FROM region WHERE region.alias_key = 'Vitebskaya'), 'Витебск', 'Vitebsk')");
        $this->connection->executeQuery("INSERT INTO city (region_id, label, alias_key) VALUES ((SELECT region.region_id FROM region WHERE region.alias_key = 'Vitebskaya'), 'Орша', 'Orsha')");

        $this->connection->executeQuery("INSERT INTO city (region_id, label, alias_key) VALUES ((SELECT region.region_id FROM region WHERE region.alias_key = 'Gomelskaya'), 'Речица', 'Rechitsa')");
        $this->connection->executeQuery("INSERT INTO city (region_id, label, alias_key) VALUES ((SELECT region.region_id FROM region WHERE region.alias_key = 'Gomelskaya'), 'Гомель', 'Gomel')");
        $this->connection->executeQuery("INSERT INTO city (region_id, label, alias_key) VALUES ((SELECT region.region_id FROM region WHERE region.alias_key = 'Gomelskaya'), 'Жлобин', 'Jlobin')");
        $this->connection->executeQuery("INSERT INTO city (region_id, label, alias_key) VALUES ((SELECT region.region_id FROM region WHERE region.alias_key = 'Gomelskaya'), 'Калинковичи', 'Kalinkovichi')");
        $this->connection->executeQuery("INSERT INTO city (region_id, label, alias_key) VALUES ((SELECT region.region_id FROM region WHERE region.alias_key = 'Gomelskaya'), 'Мозырь', 'Mozir')");
        $this->connection->executeQuery("INSERT INTO city (region_id, label, alias_key) VALUES ((SELECT region.region_id FROM region WHERE region.alias_key = 'Gomelskaya'), 'Светлогорск', 'Svetlogorsk')");

        $this->connection->executeQuery("INSERT INTO city (region_id, label, alias_key) VALUES ((SELECT region.region_id FROM region WHERE region.alias_key = 'Grodneskaya'), 'Гродно', 'Grodno')");
        $this->connection->executeQuery("INSERT INTO city (region_id, label, alias_key) VALUES ((SELECT region.region_id FROM region WHERE region.alias_key = 'Grodneskaya'), 'Лида', 'Lida')");
        $this->connection->executeQuery("INSERT INTO city (region_id, label, alias_key) VALUES ((SELECT region.region_id FROM region WHERE region.alias_key = 'Grodneskaya'), 'Слоним', 'Slonim')");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
