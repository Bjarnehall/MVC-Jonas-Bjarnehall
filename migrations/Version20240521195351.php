<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240521195351 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__adventure AS SELECT id, notes, codes, keys FROM adventure');
        $this->addSql('DROP TABLE adventure');
        $this->addSql('CREATE TABLE adventure (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, notes VARCHAR(255) DEFAULT NULL, codes VARCHAR(255) DEFAULT NULL, keys INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO adventure (id, notes, codes, keys) SELECT id, notes, codes, keys FROM __temp__adventure');
        $this->addSql('DROP TABLE __temp__adventure');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__adventure AS SELECT id, notes, codes, keys FROM adventure');
        $this->addSql('DROP TABLE adventure');
        $this->addSql('CREATE TABLE adventure (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, notes VARCHAR(255) DEFAULT NULL, codes INTEGER DEFAULT NULL, keys INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO adventure (id, notes, codes, keys) SELECT id, notes, codes, keys FROM __temp__adventure');
        $this->addSql('DROP TABLE __temp__adventure');
    }
}
