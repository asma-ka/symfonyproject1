<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200905204716 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pristation ADD pstion_dr_urgc_id INT DEFAULT NULL, ADD prstion_prstaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pristation ADD CONSTRAINT FK_6679AE21F9C7CFB FOREIGN KEY (pstion_dr_urgc_id) REFERENCES dugre_urgence (id)');
        $this->addSql('ALTER TABLE pristation ADD CONSTRAINT FK_6679AE2FF865168 FOREIGN KEY (prstion_prstaire_id) REFERENCES prestataire (id)');
        $this->addSql('CREATE INDEX IDX_6679AE21F9C7CFB ON pristation (pstion_dr_urgc_id)');
        $this->addSql('CREATE INDEX IDX_6679AE2FF865168 ON pristation (prstion_prstaire_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pristation DROP FOREIGN KEY FK_6679AE21F9C7CFB');
        $this->addSql('ALTER TABLE pristation DROP FOREIGN KEY FK_6679AE2FF865168');
        $this->addSql('DROP INDEX IDX_6679AE21F9C7CFB ON pristation');
        $this->addSql('DROP INDEX IDX_6679AE2FF865168 ON pristation');
        $this->addSql('ALTER TABLE pristation DROP pstion_dr_urgc_id, DROP prstion_prstaire_id');
    }
}
