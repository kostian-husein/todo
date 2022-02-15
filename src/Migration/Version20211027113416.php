<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 28.10.2021
 * Time: 16:20
 * Project: steelline
 */

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Add new trade_store types
 */
final class Version20211027113416 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription() : string
    {
        return 'Add new trade_store types';
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) : void
    {
        // nothing here
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Exception
     */
    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery('ALTER TABLE `store` MODIFY `type` ENUM("brand_store", "brand_section", "monobrand_store", "office", "brand_zone", "warehouse", "uncertified_store", "design_studio") NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) : void
    {
        // nothing here
    }

    public function postDown(Schema $schema): void
    {
        $this->connection->executeQuery('ALTER TABLE `trade_store` MODIFY `type` ENUM("brand_store", "brand_section", "monobrand_store", "office")');
    }
}
