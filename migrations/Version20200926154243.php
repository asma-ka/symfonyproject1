<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200926154243 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F862DFE895C');
        $this->addSql('DROP TABLE statut');
        $this->addSql('DROP INDEX IDX_10C31F862DFE895C ON rdv');
        $this->addSql('ALTER TABLE rdv ADD rdv_status VARCHAR(255) NOT NULL, DROP rdv_status_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE statut (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ordre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE rdv ADD rdv_status_id INT DEFAULT NULL, DROP rdv_status');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F862DFE895C FOREIGN KEY (rdv_status_id) REFERENCES statut (id)');
        $this->addSql('CREATE INDEX IDX_10C31F862DFE895C ON rdv (rdv_status_id)');
    }
}
