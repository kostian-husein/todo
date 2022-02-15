<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210810085746 extends AbstractMigration
{
    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Exception
     */
    public function preUp(Schema $schema): void
    {
        $this->connection->executeQuery('DELETE FROM `service` WHERE `is_active`=0');
    }

    public function up(Schema $schema): void
    {
        if ($schema->hasTable('service')) {
            $table = $schema->getTable('service');

            $table->addUniqueIndex(['label'], 'label');
        }
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('service')) {
            $table = $schema->getTable('service');

            $table->dropIndex('label');
        }
    }
}
