<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200518095043 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {

    }

    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery('
        DROP FUNCTION IF EXISTS `isSubUser`;
        CREATE FUNCTION `isSubUser`(pParentId INT, pId INT) RETURNS int(11)
        DETERMINISTIC    
        READS SQL DATA
        BEGIN
            DECLARE isChild,curId,curParent,lastParent int;
            SET isChild = 0;
            SET curId = pId;
            SET curParent = -1;
            SET lastParent = -2;

            WHILE lastParent <> curParent AND curParent <> 0 AND curId <> -1 AND curParent <> pId AND isChild = 0 DO
                SET lastParent = curParent;
                SELECT u.parent_user_id from `user` u where u.user_id = curId limit 1 into curParent;

                IF curParent = pParentId THEN
                    SET isChild = 1;
                END IF;
                SET curId = curParent;
            END WHILE;

            RETURN isChild;
        END'
        );
    }

    public function down(Schema $schema) : void
    {

    }

    public function postDown(Schema $schema): void
    {
        $this->connection->executeQuery('DROP FUNCTION IF EXISTS `isSubUser`;');
    }
}
