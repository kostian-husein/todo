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
 * Add user_action table and last_user_id columns
 */
final class Version20200706082608 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription() : string
    {
        return 'Add user_action table and last_user_id columns';
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function up(Schema $schema) : void
    {
        if (!$schema->hasTable('user_action')) {
            $table = $schema->createTable('user_action');

            $table->addColumn('action_id', 'integer', ['unsigned' => true, 'notnull' => true, 'autoincrement' => true]);
            $table->addColumn('user_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('data', 'json', ['notnull' => true]);
            $table->addColumn('entity', 'string', ['notnull' => false, 'default' => null]);
            $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
            $table->addColumn('entity_id', 'integer', ['unsigned' => true, 'notnull' => false, 'default' => null]);
            $table->addColumn('action', 'string', ['notnull' => true, 'default' => 'custom']);
            $table->addColumn('comment', 'string', ['notnull' => false, 'default' => null]);

            $table->setPrimaryKey(['action_id']);
            $table->addIndex(['user_id'], 'user_id');

            $table->addForeignKeyConstraint('user', ['user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_LAST_USER_ACTION');
        }

        if ($schema->hasTable('attendant_parameter')) {
            $table = $schema->getTable('attendant_parameter');

            if (!$table->hasColumn('last_user_id')) {
                $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => true, 'default'=>1]);
                $table->addIndex(['last_user_id'], 'last_user_id');
                $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_ATTENDANT_PARAM_LAST_USER');
            }
        }

        if ($schema->hasTable('city_coefficient')) {
            $table = $schema->getTable('city_coefficient');

            if (!$table->hasColumn('last_user_id')) {
                $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => true, 'default'=>1]);
                $table->addIndex(['last_user_id'], 'last_user_id');
                $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_CITY_COEFFICIENT_LAST_USER');
            }
        }

        if ($schema->hasTable('coefficient_to_base')) {
            $table = $schema->getTable('coefficient_to_base');

            if (!$table->hasColumn('last_user_id')) {
                $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => true, 'default'=>1]);
                $table->addIndex(['last_user_id'], 'last_user_id');
                $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_COEFFICIENT_TO_BASE_LAST_USER');
            }
        }

        if ($schema->hasTable('country_coefficient')) {
            $table = $schema->getTable('country_coefficient');

            if (!$table->hasColumn('last_user_id')) {
                $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => true, 'default'=>1]);
                $table->addIndex(['last_user_id'], 'last_user_id');
                $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_COUNTRY_COEFFICIENT_LAST_USER');
            }
        }

        if ($schema->hasTable('country_extra_charge')) {
            $table = $schema->getTable('country_extra_charge');

            if (!$table->hasColumn('last_user_id')) {
                $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => true, 'default'=>1]);
                $table->addIndex(['last_user_id'], 'last_user_id');
                $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_COUNTRY_EXTRA_CHARGE_LAST_USER');
            }
        }

        if ($schema->hasTable('parameter_condition')) {
            $table = $schema->getTable('parameter_condition');

            if (!$table->hasColumn('last_user_id')) {
                $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => true, 'default'=>1]);
                $table->addIndex(['last_user_id'], 'last_user_id');
                $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_PARAMETER_CONDITION_LAST_USER');
            }
        }

        if ($schema->hasTable('parameter_dependencies')) {
            $table = $schema->getTable('parameter_dependencies');

            if (!$table->hasColumn('last_user_id')) {
                $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => true, 'default'=>1]);
                $table->addIndex(['last_user_id'], 'last_user_id');
                $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_PARAMETER_DEPENDENCY_LAST_USER');
            }
        }

        if ($schema->hasTable('parameter_dimension')) {
            $table = $schema->getTable('parameter_dimension');

            if (!$table->hasColumn('last_user_id')) {
                $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => true, 'default'=>1]);
                $table->addIndex(['last_user_id'], 'last_user_id');
                $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_PARAMETER_DIMENSION_LAST_USER');
            }
        }

        if ($schema->hasTable('parameter_mandatory_condition')) {
            $table = $schema->getTable('parameter_mandatory_condition');

            if (!$table->hasColumn('last_user_id')) {
                $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => true, 'default'=>1]);
                $table->addIndex(['last_user_id'], 'last_user_id');
                $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_PMC_LAST_USER');
            }
        }

        if ($schema->hasTable('parameter_price')) {
            $table = $schema->getTable('parameter_price');

            if (!$table->hasColumn('last_user_id')) {
                $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => true, 'default'=>1]);
                $table->addIndex(['last_user_id'], 'last_user_id');
                $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_PARAMETER_PRICE_LAST_USER');
            }
        }

        if ($schema->hasTable('price_for_dimension')) {
            $table = $schema->getTable('price_for_dimension');

            if (!$table->hasColumn('last_user_id')) {
                $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => true, 'default'=>1]);
                $table->addIndex(['last_user_id'], 'last_user_id');
                $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_PRICE_FOR_DIMENSION_LAST_USER');
            }
        }

        if ($schema->hasTable('product_type')) {
            $table = $schema->getTable('product_type');

            if (!$table->hasColumn('last_user_id')) {
                $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => true, 'default'=>1]);
                $table->addIndex(['last_user_id'], 'last_user_id');
                $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_PRODUCT_TYPE_LAST_USER');
            }
        }

        if ($schema->hasTable('region_coefficient')) {
            $table = $schema->getTable('region_coefficient');

            if (!$table->hasColumn('last_user_id')) {
                $table->addColumn('last_user_id', 'integer', ['unsigned' => true, 'notnull' => true, 'default'=>1]);
                $table->addIndex(['last_user_id'], 'last_user_id');
                $table->addForeignKeyConstraint('user', ['last_user_id'], ['user_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_REGION_COEFFICIENT_LAST_USER');
            }
        }
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\DBALException
     */
    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery('ALTER TABLE user_action MODIFY action ENUM("create", "update", "delete", "restore", "deactivate", "activate", "custom") NOT NULL DEFAULT "custom"');
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('user_action')) {
            $table = $schema->getTable('user_action');

            if ($table->hasForeignKey('FK_LAST_USER_ACTION')) {
                $table->removeForeignKey('FK_LAST_USER_ACTION');
            }

            $schema->dropTable('user_action');
        }

        if ($schema->hasTable('attendant_parameter')) {
            $table = $schema->getTable('attendant_parameter');

            if ($table->hasForeignKey('FK_ATTENDANT_PARAM_LAST_USER')) {
                $table->removeForeignKey('FK_ATTENDANT_PARAM_LAST_USER');
            }

            if ($table->hasIndex('last_user_id')) {
                $table->dropIndex('last_user_id');
            }

            if ($table->hasColumn('last_user_id')) {
                $table->dropColumn('last_user_id');
            }
        }

        if ($schema->hasTable('city_coefficient')) {
            $table = $schema->getTable('city_coefficient');

            if ($table->hasForeignKey('FK_CITY_COEFFICIENT_LAST_USER')) {
                $table->removeForeignKey('FK_CITY_COEFFICIENT_LAST_USER');
            }

            if ($table->hasIndex('last_user_id')) {
                $table->dropIndex('last_user_id');
            }

            if ($table->hasColumn('last_user_id')) {
                $table->dropColumn('last_user_id');
            }
        }

        if ($schema->hasTable('coefficient_to_base')) {
            $table = $schema->getTable('coefficient_to_base');

            if ($table->hasForeignKey('FK_COEFFICIENT_TO_BASE_LAST_USER')) {
                $table->removeForeignKey('FK_COEFFICIENT_TO_BASE_LAST_USER');
            }

            if ($table->hasIndex('last_user_id')) {
                $table->dropIndex('last_user_id');
            }

            if ($table->hasColumn('last_user_id')) {
                $table->dropColumn('last_user_id');
            }
        }

        if ($schema->hasTable('country_coefficient')) {
            $table = $schema->getTable('country_coefficient');

            if ($table->hasForeignKey('FK_COUNTRY_COEFFICIENT_LAST_USER')) {
                $table->removeForeignKey('FK_COUNTRY_COEFFICIENT_LAST_USER');
            }

            if ($table->hasIndex('last_user_id')) {
                $table->dropIndex('last_user_id');
            }

            if ($table->hasColumn('last_user_id')) {
                $table->dropColumn('last_user_id');
            }
        }

        if ($schema->hasTable('country_extra_charge')) {
            $table = $schema->getTable('country_extra_charge');

            if ($table->hasForeignKey('FK_COUNTRY_EXTRA_CHARGE_LAST_USER')) {
                $table->removeForeignKey('FK_COUNTRY_EXTRA_CHARGE_LAST_USER');
            }

            if ($table->hasIndex('last_user_id')) {
                $table->dropIndex('last_user_id');
            }

            if ($table->hasColumn('last_user_id')) {
                $table->dropColumn('last_user_id');
            }
        }

        if ($schema->hasTable('parameter_condition')) {
            $table = $schema->getTable('parameter_condition');

            if ($table->hasForeignKey('FK_PARAMETER_CONDITION_LAST_USER')) {
                $table->removeForeignKey('FK_PARAMETER_CONDITION_LAST_USER');
            }

            if ($table->hasIndex('last_user_id')) {
                $table->dropIndex('last_user_id');
            }

            if ($table->hasColumn('last_user_id')) {
                $table->dropColumn('last_user_id');
            }
        }

        if ($schema->hasTable('parameter_dependencies')) {
            $table = $schema->getTable('parameter_dependencies');

            if ($table->hasForeignKey('FK_PARAMETER_DEPENDENCY_LAST_USER')) {
                $table->removeForeignKey('FK_PARAMETER_DEPENDENCY_LAST_USER');
            }

            if ($table->hasIndex('last_user_id')) {
                $table->dropIndex('last_user_id');
            }

            if ($table->hasColumn('last_user_id')) {
                $table->dropColumn('last_user_id');
            }
        }

        if ($schema->hasTable('parameter_dimension')) {
            $table = $schema->getTable('parameter_dimension');

            if ($table->hasForeignKey('FK_PARAMETER_DIMENSION_LAST_USER')) {
                $table->removeForeignKey('FK_PARAMETER_DIMENSION_LAST_USER');
            }

            if ($table->hasIndex('last_user_id')) {
                $table->dropIndex('last_user_id');
            }

            if ($table->hasColumn('last_user_id')) {
                $table->dropColumn('last_user_id');
            }
        }

        if ($schema->hasTable('parameter_mandatory_condition')) {
            $table = $schema->getTable('parameter_mandatory_condition');

            if ($table->hasForeignKey('FK_PMC_LAST_USER')) {
                $table->removeForeignKey('FK_PMC_LAST_USER');
            }

            if ($table->hasIndex('last_user_id')) {
                $table->dropIndex('last_user_id');
            }

            if ($table->hasColumn('last_user_id')) {
                $table->dropColumn('last_user_id');
            }
        }

        if ($schema->hasTable('parameter_price')) {
            $table = $schema->getTable('parameter_price');

            if ($table->hasForeignKey('FK_PARAMETER_PRICE_LAST_USER')) {
                $table->removeForeignKey('FK_PARAMETER_PRICE_LAST_USER');
            }

            if ($table->hasIndex('last_user_id')) {
                $table->dropIndex('last_user_id');
            }

            if ($table->hasColumn('last_user_id')) {
                $table->dropColumn('last_user_id');
            }
        }

        if ($schema->hasTable('price_for_dimension')) {
            $table = $schema->getTable('price_for_dimension');

            if ($table->hasForeignKey('FK_PRICE_FOR_DIMENSION_LAST_USER')) {
                $table->removeForeignKey('FK_PRICE_FOR_DIMENSION_LAST_USER');
            }

            if ($table->hasIndex('last_user_id')) {
                $table->dropIndex('last_user_id');
            }

            if ($table->hasColumn('last_user_id')) {
                $table->dropColumn('last_user_id');
            }
        }

        if ($schema->hasTable('product_type')) {
            $table = $schema->getTable('product_type');

            if ($table->hasForeignKey('FK_PRODUCT_TYPE_LAST_USER')) {
                $table->removeForeignKey('FK_PRODUCT_TYPE_LAST_USER');
            }

            if ($table->hasIndex('last_user_id')) {
                $table->dropIndex('last_user_id');
            }

            if ($table->hasColumn('last_user_id')) {
                $table->dropColumn('last_user_id');
            }
        }

        if ($schema->hasTable('region_coefficient')) {
            $table = $schema->getTable('region_coefficient');

            if ($table->hasForeignKey('FK_REGION_COEFFICIENT_LAST_USER')) {
                $table->removeForeignKey('FK_REGION_COEFFICIENT_LAST_USER');
            }

            if ($table->hasIndex('last_user_id')) {
                $table->dropIndex('last_user_id');
            }

            if ($table->hasColumn('last_user_id')) {
                $table->dropColumn('last_user_id');
            }
        }
    }
}
