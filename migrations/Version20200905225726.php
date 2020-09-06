<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200905225726 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rdv ADD rdv_ligne_id INT DEFAULT NULL, ADD rdv_eqipment_id INT DEFAULT NULL, ADD rdv_prestation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F863A7416D9 FOREIGN KEY (rdv_ligne_id) REFERENCES ligne (id)');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F8635192D76 FOREIGN KEY (rdv_eqipment_id) REFERENCES equipement (id)');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F86501F9CEA FOREIGN KEY (rdv_prestation_id) REFERENCES prestation (id)');
        $this->addSql('CREATE INDEX IDX_10C31F863A7416D9 ON rdv (rdv_ligne_id)');
        $this->addSql('CREATE INDEX IDX_10C31F8635192D76 ON rdv (rdv_eqipment_id)');
        $this->addSql('CREATE INDEX IDX_10C31F86501F9CEA ON rdv (rdv_prestation_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F863A7416D9');
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F8635192D76');
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F86501F9CEA');
        $this->addSql('DROP INDEX IDX_10C31F863A7416D9 ON rdv');
        $this->addSql('DROP INDEX IDX_10C31F8635192D76 ON rdv');
        $this->addSql('DROP INDEX IDX_10C31F86501F9CEA ON rdv');
        $this->addSql('ALTER TABLE rdv DROP rdv_ligne_id, DROP rdv_eqipment_id, DROP rdv_prestation_id');
    }
}
