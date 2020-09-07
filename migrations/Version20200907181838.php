<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200907181838 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rdv ADD rdv_status_id INT DEFAULT NULL, ADD rdv_motif_id INT DEFAULT NULL, ADD rdv_zone_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F862DFE895C FOREIGN KEY (rdv_status_id) REFERENCES statut (id)');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F86B0D920B6 FOREIGN KEY (rdv_motif_id) REFERENCES motif (id)');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F86183A4534 FOREIGN KEY (rdv_zone_id) REFERENCES zone (id)');
        $this->addSql('CREATE INDEX IDX_10C31F862DFE895C ON rdv (rdv_status_id)');
        $this->addSql('CREATE INDEX IDX_10C31F86B0D920B6 ON rdv (rdv_motif_id)');
        $this->addSql('CREATE INDEX IDX_10C31F86183A4534 ON rdv (rdv_zone_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F862DFE895C');
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F86B0D920B6');
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F86183A4534');
        $this->addSql('DROP INDEX IDX_10C31F862DFE895C ON rdv');
        $this->addSql('DROP INDEX IDX_10C31F86B0D920B6 ON rdv');
        $this->addSql('DROP INDEX IDX_10C31F86183A4534 ON rdv');
        $this->addSql('ALTER TABLE rdv DROP rdv_status_id, DROP rdv_motif_id, DROP rdv_zone_id');
    }
}
