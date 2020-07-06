<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200706221344 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE livre_users (livre_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_87803D8F37D925CB (livre_id), INDEX IDX_87803D8F67B3B43D (users_id), PRIMARY KEY(livre_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE livre_users ADD CONSTRAINT FK_87803D8F37D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_users ADD CONSTRAINT FK_87803D8F67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre ADD facture_id INT NOT NULL');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F997F2DEE08 FOREIGN KEY (facture_id) REFERENCES factures (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AC634F997F2DEE08 ON livre (facture_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE livre_users');
        $this->addSql('ALTER TABLE livre DROP FOREIGN KEY FK_AC634F997F2DEE08');
        $this->addSql('DROP INDEX UNIQ_AC634F997F2DEE08 ON livre');
        $this->addSql('ALTER TABLE livre DROP facture_id');
    }
}
