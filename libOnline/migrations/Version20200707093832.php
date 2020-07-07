<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200707093832 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oeuvre (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(45) NOT NULL, editeur VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oeuvre_categorie (oeuvre_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_50ED1EBF88194DE8 (oeuvre_id), INDEX IDX_50ED1EBFBCF5E72D (categorie_id), PRIMARY KEY(oeuvre_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE oeuvre_categorie ADD CONSTRAINT FK_50ED1EBF88194DE8 FOREIGN KEY (oeuvre_id) REFERENCES oeuvre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oeuvre_categorie ADD CONSTRAINT FK_50ED1EBFBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre ADD oeuvre_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F9988194DE8 FOREIGN KEY (oeuvre_id) REFERENCES oeuvre (id)');
        $this->addSql('CREATE INDEX IDX_AC634F9988194DE8 ON livre (oeuvre_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE oeuvre_categorie DROP FOREIGN KEY FK_50ED1EBFBCF5E72D');
        $this->addSql('ALTER TABLE livre DROP FOREIGN KEY FK_AC634F9988194DE8');
        $this->addSql('ALTER TABLE oeuvre_categorie DROP FOREIGN KEY FK_50ED1EBF88194DE8');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE oeuvre');
        $this->addSql('DROP TABLE oeuvre_categorie');
        $this->addSql('DROP INDEX IDX_AC634F9988194DE8 ON livre');
        $this->addSql('ALTER TABLE livre DROP oeuvre_id');
    }
}
