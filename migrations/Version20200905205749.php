<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200905205749 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE prestation (id INT AUTO_INCREMENT NOT NULL, pstion_dr_urgc_id INT DEFAULT NULL, prstion_prstaire_id INT DEFAULT NULL, numero_prestation INT NOT NULL, titre VARCHAR(255) NOT NULL, genre VARCHAR(255) NOT NULL, INDEX IDX_51C88FAD1F9C7CFB (pstion_dr_urgc_id), INDEX IDX_51C88FADFF865168 (prstion_prstaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE prestation ADD CONSTRAINT FK_51C88FAD1F9C7CFB FOREIGN KEY (pstion_dr_urgc_id) REFERENCES dugre_urgence (id)');
        $this->addSql('ALTER TABLE prestation ADD CONSTRAINT FK_51C88FADFF865168 FOREIGN KEY (prstion_prstaire_id) REFERENCES prestataire (id)');
        $this->addSql('DROP TABLE pristation');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pristation (id INT AUTO_INCREMENT NOT NULL, pstion_dr_urgc_id INT DEFAULT NULL, prstion_prstaire_id INT DEFAULT NULL, numero_pristation INT NOT NULL, titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, genre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_6679AE21F9C7CFB (pstion_dr_urgc_id), INDEX IDX_6679AE2FF865168 (prstion_prstaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE pristation ADD CONSTRAINT FK_6679AE21F9C7CFB FOREIGN KEY (pstion_dr_urgc_id) REFERENCES dugre_urgence (id)');
        $this->addSql('ALTER TABLE pristation ADD CONSTRAINT FK_6679AE2FF865168 FOREIGN KEY (prstion_prstaire_id) REFERENCES prestataire (id)');
        $this->addSql('DROP TABLE prestation');
    }
}
