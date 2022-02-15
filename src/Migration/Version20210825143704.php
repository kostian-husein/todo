<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210825143704 extends AbstractMigration
{

    public function up(Schema $schema): void
    {
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Exception
     */
    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery("DELETE FROM `city_coefficient` WHERE `value_id`=2425;");
        $this->connection->executeQuery("INSERT `city_coefficient`(`city_id`, `value_id`, `coefficient`, `coefficient_mark`, `last_user_id`, `partner_coefficient`, `partner_marker_coefficient`, `delivery_price`, `delivery_price_extra`, `partner_delivery_price`, `partner_delivery_price_extra`, `coefficient_sun`, `partner_coefficient_sun`)
                                        SELECT `city_id`, 2425 AS `value_id`, `coefficient`, `coefficient_mark`, `last_user_id`, `partner_coefficient`, `partner_marker_coefficient`, `delivery_price`, `delivery_price_extra`, `partner_delivery_price`, `partner_delivery_price_extra`, `coefficient_sun`, `partner_coefficient_sun` FROM `city_coefficient` WHERE `value_id`=7608;");
        $this->connection->executeQuery("DELETE FROM `region_coefficient` WHERE `value_id`=2425;");
        $this->connection->executeQuery("INSERT `region_coefficient`(`region_id`, `value_id`, `coefficient`, `coefficient_mark`, `last_user_id`, `partner_coefficient`, `partner_marker_coefficient`, `delivery_price`, `delivery_price_extra`, `partner_delivery_price`, `partner_delivery_price_extra`, `coefficient_sun`, `partner_coefficient_sun`)
                                        SELECT `region_id`, 2425 AS `value_id`, `coefficient`, `coefficient_mark`, `last_user_id`, `partner_coefficient`, `partner_marker_coefficient`, `delivery_price`, `delivery_price_extra`, `partner_delivery_price`, `partner_delivery_price_extra`, `coefficient_sun`, `partner_coefficient_sun` FROM `region_coefficient` WHERE `value_id`=7608;");
        $this->connection->executeQuery("DELETE FROM `country_coefficient` WHERE `value_id`=2425;");
        $this->connection->executeQuery("INSERT `country_coefficient`(`country_id`, `value_id`, `coefficient`, `coefficient_mark`, `last_user_id`, `partner_coefficient`, `partner_marker_coefficient`, `delivery_price`, `delivery_price_extra`, `partner_delivery_price`, `partner_delivery_price_extra`, `coefficient_sun`, `partner_coefficient_sun`)
                                        SELECT `country_id`, 2425 AS `value_id`, `coefficient`, `coefficient_mark`, `last_user_id`, `partner_coefficient`, `partner_marker_coefficient`, `delivery_price`, `delivery_price_extra`, `partner_delivery_price`, `partner_delivery_price_extra`, `coefficient_sun`, `partner_coefficient_sun` FROM `country_coefficient` WHERE `value_id`=7608;");
    }

    public function down(Schema $schema): void
    {
    }
}
