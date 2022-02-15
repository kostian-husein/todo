<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210317061930 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('client_order')) {
            $table = $schema->getTable('client_order');

            if (!$table->hasColumn('created_from_user_id')) {
                $table->addColumn('created_from_user_id', 'integer', ['unsigned'=>true, 'notnull' => false]);
                $table->addIndex(['created_from_user_id'], 'created_from_user_id');
                $table->addForeignKeyConstraint('user', ['created_from_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_USER_CLIENT_CREATED_FROM_USER_ID');
            }
        }

        if ($schema->hasTable('order_status')) {
            $table = $schema->getTable('order_status');

            if (! $table->hasColumn('alias_code')) {
                $table->addColumn('alias_code', 'string', ['length' => 255, 'notnull' => false]);
            }
        }
    }

    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery("UPDATE order_status SET alias_code = 'draft', label = 'Черновик' WHERE label = 'Заготовка'");
        $this->connection->executeQuery("UPDATE order_status SET alias_code = 'measuring' WHERE label = 'Замер'");
        $this->connection->executeQuery("UPDATE order_status SET alias_code = 'agreement' WHERE label = 'На согласовании'");
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('client_order')) {
            $table = $schema->getTable('client_order');

            if ($table->hasForeignKey('FK_USER_CLIENT_CREATED_FROM_USER_ID')) {
                $table->removeForeignKey('FK_USER_CLIENT_CREATED_FROM_USER_ID');
            }

            if ($table->hasColumn('created_from_user_id')) {
                $table->dropColumn('created_from_user_id');
            }
        }

        if ($schema->hasTable('order_status')) {
            $table = $schema->getTable('order_status');

            if (! $table->hasColumn('alias_code')) {
                $table->addColumn('alias_code', 'string', ['length' => 255, 'notnull' => false]);
            }
        }
    }
}
