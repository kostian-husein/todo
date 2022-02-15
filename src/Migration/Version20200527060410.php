<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 08.07.2020
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
final class Version20200527060410 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {

    }

    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery('INSERT INTO region (country_id, label, alias_key) SELECT country_id, \'Приволжский федеральный округ\', \'VFD\' FROM country WHERE alias_key = \'Russia\'');
        $this->connection->executeQuery('INSERT INTO city (region_id, label, alias_key) SELECT region_id, \'Самара\', \'Samara\' FROM region WHERE alias_key = \'VFD\'');
        $this->connection->executeQuery('INSERT INTO city (region_id, label, alias_key) SELECT region_id, \'Пермь\', \'Perm\' FROM region WHERE alias_key = \'VFD\'');

        $this->connection->executeQuery('INSERT INTO region (country_id, label, alias_key) SELECT country_id, \'Уральский федеральный округ\', \'UFD\' FROM country WHERE alias_key = \'Russia\'');
        $this->connection->executeQuery('INSERT INTO city (region_id, label, alias_key) SELECT region_id, \'Екатеринбург\', \'Ekaterinburg\' FROM region WHERE alias_key = \'UFD\'');
        $this->connection->executeQuery('INSERT INTO city (region_id, label, alias_key) SELECT region_id, \'Тюмень\', \'Tiumen\' FROM region WHERE alias_key = \'UFD\'');
        $this->connection->executeQuery('INSERT INTO city (region_id, label, alias_key) SELECT region_id, \'Челябинск\', \'Cheliabinsk\' FROM region WHERE alias_key = \'UFD\'');
    }

    public function down(Schema $schema) : void
    {

    }
}
