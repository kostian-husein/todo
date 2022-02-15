<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201201130709 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('role')) {
            $table = $schema->getTable('role');

            if ( ! $table->hasColumn('parent_role_id')) {
                $table->addColumn('parent_role_id', 'integer', ['unsigned' => true, 'notnull'=> false]);
                $table->addForeignKeyConstraint('role', ['parent_role_id'], ['role_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_ROLE_PARENT_ROLE');
            }

            if ( ! $table->hasColumn('path')) {
                $table->addColumn('path', 'string', ['notnull' => false, 'length' => 255]);
            }
        }
    }

    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery("UPDATE `role` chRole INNER JOIN role prRole ON prRole.label LIKE 'Разработчик' SET chRole.parent_role_id = prRole.role_id, chRole.path = CONCAT_WS(',', prRole.path, prRole.role_id) WHERE chRole.label LIKE 'Админ'");
        $this->connection->executeQuery("UPDATE `role` chRole INNER JOIN role prRole ON prRole.label LIKE 'Админ' SET chRole.parent_role_id = prRole.role_id, chRole.path = CONCAT_WS(',', prRole.path, prRole.role_id) WHERE chRole.label LIKE 'Дистрибьютор'");
        $this->connection->executeQuery("UPDATE `role` chRole INNER JOIN role prRole ON prRole.label LIKE 'Дистрибьютор' SET chRole.parent_role_id = prRole.role_id, chRole.path = CONCAT_WS(',', prRole.path, prRole.role_id) WHERE chRole.label LIKE 'Дилер'");
        $this->connection->executeQuery("UPDATE `role` chRole INNER JOIN role prRole ON prRole.label LIKE 'Дилер' SET chRole.parent_role_id = prRole.role_id, chRole.path = CONCAT_WS(',', prRole.path, prRole.role_id) WHERE chRole.label LIKE 'Менеджер'");
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('role')) {
            $table = $schema->getTable('role');

            if ($table->hasForeignKey('FK_ROLE_PARENT_ROLE')) {
                $table->removeForeignKey('FK_ROLE_PARENT_ROLE');
            }

            if ($table->hasColumn('parent_role_id')) {
                $table->dropColumn('parent_role_id');
            }

            if ( $table->hasColumn('path')) {
                $table->dropColumn('path');
            }
        }
    }
}
