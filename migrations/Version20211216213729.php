<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211216213729 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $date = date('Y-m-d H:i:s');

        $dataColumns = [
            ['id' => '1', 'title' => 'thisSomeTitle', 'test_column' => 'testText', 'date' => $date],
            ['id' => '2', 'title' => 'thisSomeTitle2', 'test_column' => 'testText2', 'date' => $date],
            ['id' => '3', 'title' => 'thisSomeTitle3', 'test_column' => 'testText3', 'date' => $date],
        ];
        foreach ($dataColumns as $data) {
            $this->addSql("INSERT INTO example_table (id, title, test_column, `date`) VALUES (:id, :title, :test_column, :date)", $data );
        }
        // this up() migration is auto-generated, please modify it to your needs

    }

    public function down(Schema $schema): void
    {
        $this->addSql('DELETE FROM example_table');
        // this down() migration is auto-generated, please modify it to your needs

    }
}
