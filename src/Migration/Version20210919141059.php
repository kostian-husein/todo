<?php

declare(strict_types=1);

namespace Application\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210919141059 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        if ($schema->hasTable('order_item')) {
            $table = $schema->getTable('order_item');

            if (!$table->hasColumn('product_type_label')) {
                $table->addColumn('product_type_label', 'string', ['notnull' => false, 'length' => 255]);
            }
        }
    }

    public function postUp(Schema $schema): void
    {
        $sql = "UPDATE order_item oi
                    INNER JOIN
                    (SELECT item_id,
                            TRIM(CONCAT(
                                    CASE
                                        WHEN JSON_EXTRACT(oiSub.data, '$.productTypeId') = 1
                                            THEN 'Пороги/Молдинги'
                                        WHEN JSON_EXTRACT(oiSub.data, '$.productTypeId') = 2
                                            THEN 'Комплект откосов МДФ'
                                        WHEN JSON_EXTRACT(oiSub.data, '$.productTypeId') = 3
                                            THEN 'Монтажные пластины'
                                        WHEN JSON_EXTRACT(oiSub.data, '$.productTypeId') = 4 THEN 'Комплектующие'
                                        WHEN JSON_EXTRACT(oiSub.data, '$.productTypeId') = 5 THEN
                                            IF(JSON_EXTRACT(oiSub.data, '$.formType') = 'individual', 'Дверь уличная',
                                               JSON_UNQUOTE(JSON_EXTRACT(oiSub.data,
                                                            '$.params.\"191443d7-9800-45cd-9476-d1bafe4dd816\".value.label')))
                                        WHEN JSON_EXTRACT(oiSub.data, '$.productTypeId') = 11
                                            THEN IF(JSON_EXTRACT(oiSub.data, '$.formType') = 'individual', 'Дверь металическая',
                                                    JSON_UNQUOTE(JSON_EXTRACT(oiSub.data,
                                                                 '$.params.\"191443d7-9800-45cd-9476-d1bafe4dd816\".value.label')))
                                        WHEN JSON_EXTRACT(oiSub.data, '$.productTypeId') = 14 THEN 'Ремонт'
                                        WHEN JSON_EXTRACT(oiSub.data, '$.productTypeId') = 15
                                            THEN 'Прочая продукция'
                                        WHEN JSON_EXTRACT(oiSub.data, '$.productTypeId') = 18
                                            THEN 'Наличники/доборы МДФ'
                                        WHEN JSON_EXTRACT(oiSub.data, '$.productTypeId') = 20
                                            THEN 'Доборы для дверей комбинированных'
                                        END,
                                    IF(oiSub.code IS NOT NULL, ' №', ''),
                                    IF(oiSub.code IS NOT NULL, oiSub.code, ''),
                                    ' ',
                                    IF(JSON_UNQUOTE(JSON_EXTRACT(oiSub.data, '$.params.width.value.id')) IS NOT NULL,
                                       JSON_UNQUOTE(JSON_EXTRACT(oiSub.data, '$.params.width.value.id')), ''),
                                    IF(JSON_UNQUOTE(JSON_EXTRACT(oiSub.data, '$.params.width.value.id')) IS NOT NULL, '*', ''),
                                    IF(JSON_UNQUOTE(JSON_EXTRACT(oiSub.data, '$.params.height.value.id')) IS NOT NULL,
                                       JSON_UNQUOTE(JSON_EXTRACT(oiSub.data, '$.params.height.value.id')), ''),
                                    IF(JSON_UNQUOTE(JSON_EXTRACT(oiSub.data, '$.params.openingSide.value.id')) IS NOT NULL,
                                       IF(JSON_UNQUOTE(JSON_EXTRACT(oiSub.data, '$.params.openingSide.value.id')) = 'left', ', Левая',
                                          ', Правая'), ''))
                                ) AS label
                         FROM order_item oiSub
                        ) oi2 USING (item_id)
                    SET oi.product_type_label = oi2.label;
";

        $this->connection->executeQuery($sql);
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('order_item')) {
            $table = $schema->getTable('order_item');

            if ($table->hasColumn('product_type_label')) {
                $table->dropColumn('product_type_label');
            }
        }
    }
}
