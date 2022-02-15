<?php
/**
 * Created by PhpStorm.
 * User: zhuralex172
 * Date: 08.10.2021
 * Time: 08:20
 * Project: steelline
 */

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Change bitrix_number column type in client_order table
 */
final class Version20211007231152 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription() : string
    {
        return 'Change bitrix_number column type in client_order table';
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Exception
     */
    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery('ALTER TABLE client_order MODIFY bitrix_number VARCHAR(255) NULL DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Exception
     */
    public function postDown(Schema $schema) : void
    {
        $this->connection->executeQuery('ALTER TABLE client_order MODIFY bitrix_number INT(10) NULL DEFAULT NULL');
    }
}
