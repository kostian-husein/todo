<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 14.10.2021
 * Time: 13:20
 * Project: steelline
 */

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Change attendant_value_str column on attendant_parameter table
 */
final class Version20211014130809 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription() : string
    {
        return 'Change attendant_value_str column on attendant_parameter table';
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) : void
    {
        // no code here
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Exception
     */
    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery('ALTER TABLE `attendant_parameter` MODIFY `attendant_value_str` VARCHAR(255) NULL DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) : void
    {
        // no code here
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Exception
     */
    public function postDown(Schema $schema): void
    {
        $this->connection->executeQuery('ALTER TABLE `attendant_parameter` MODIFY `attendant_value_str` VARCHAR(50) NULL DEFAULT NULL');
    }
}
