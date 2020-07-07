<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200707080103 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commandes ADD facture_id INT NOT NULL');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C7F2DEE08 FOREIGN KEY (facture_id) REFERENCES factures (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_35D4282C7F2DEE08 ON commandes (facture_id)');
        $this->addSql('ALTER TABLE livre DROP FOREIGN KEY FK_AC634F997F2DEE08');
        $this->addSql('DROP INDEX UNIQ_AC634F997F2DEE08 ON livre');
        $this->addSql('ALTER TABLE livre DROP facture_id');
        $this->addSql('ALTER TABLE users ADD is_verified TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C7F2DEE08');
        $this->addSql('DROP INDEX UNIQ_35D4282C7F2DEE08 ON commandes');
        $this->addSql('ALTER TABLE commandes DROP facture_id');
        $this->addSql('ALTER TABLE livre ADD facture_id INT NOT NULL');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F997F2DEE08 FOREIGN KEY (facture_id) REFERENCES factures (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AC634F997F2DEE08 ON livre (facture_id)');
        $this->addSql('ALTER TABLE users DROP is_verified');
    }
}
