<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200918152351 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prestation DROP FOREIGN KEY FK_51C88FAD1F9C7CFB');
        $this->addSql('DROP TABLE dugre_urgence');
        $this->addSql('ALTER TABLE prestation DROP FOREIGN KEY FK_51C88FADFF865168');
        $this->addSql('DROP INDEX IDX_51C88FADFF865168 ON prestation');
        $this->addSql('DROP INDEX IDX_51C88FAD1F9C7CFB ON prestation');
        $this->addSql('ALTER TABLE prestation DROP pstion_dr_urgc_id, DROP prstion_prstaire_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dugre_urgence (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ordre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, actif TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE prestation ADD pstion_dr_urgc_id INT DEFAULT NULL, ADD prstion_prstaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE prestation ADD CONSTRAINT FK_51C88FAD1F9C7CFB FOREIGN KEY (pstion_dr_urgc_id) REFERENCES dugre_urgence (id)');
        $this->addSql('ALTER TABLE prestation ADD CONSTRAINT FK_51C88FADFF865168 FOREIGN KEY (prstion_prstaire_id) REFERENCES prestataire (id)');
        $this->addSql('CREATE INDEX IDX_51C88FADFF865168 ON prestation (prstion_prstaire_id)');
        $this->addSql('CREATE INDEX IDX_51C88FAD1F9C7CFB ON prestation (pstion_dr_urgc_id)');
    }
}
