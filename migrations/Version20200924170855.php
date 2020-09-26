<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200924170855 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, type_identification VARCHAR(255) NOT NULL, numero_identification INT NOT NULL, adress VARCHAR(255) NOT NULL, numero_contrat INT NOT NULL, cordonees LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competence (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipement (id INT AUTO_INCREMENT NOT NULL, adress_mac VARCHAR(255) NOT NULL, numero_serie VARCHAR(255) NOT NULL, garentie INT NOT NULL, date_db_gartie DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne (id INT AUTO_INCREMENT NOT NULL, numer_ligne INT NOT NULL, plan_tarifaire VARCHAR(255) NOT NULL, duree_engagement INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE motif (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, ordre VARCHAR(255) NOT NULL, actif TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestataire (id INT AUTO_INCREMENT NOT NULL, prtaire_compc_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephon VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, address VARCHAR(255) NOT NULL, INDEX IDX_60A26480EA80731C (prtaire_compc_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestation (id INT AUTO_INCREMENT NOT NULL, numero_prestation INT NOT NULL, titre VARCHAR(255) NOT NULL, genre VARCHAR(255) NOT NULL, degree_urgence VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rdv (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, rdv_ligne_id INT DEFAULT NULL, rdv_eqipment_id INT DEFAULT NULL, rdv_prestation_id INT DEFAULT NULL, customer_id INT DEFAULT NULL, rdv_status_id INT DEFAULT NULL, rdv_motif_id INT DEFAULT NULL, rdv_zone_id INT DEFAULT NULL, prestataire_id INT DEFAULT NULL, numero_rdv INT NOT NULL, resultat VARCHAR(255) NOT NULL, commentaire LONGTEXT NOT NULL, prix DOUBLE PRECISION NOT NULL, client_satisfat TINYINT(1) NOT NULL, date_creation VARCHAR(255) NOT NULL, INDEX IDX_10C31F86F675F31B (author_id), INDEX IDX_10C31F863A7416D9 (rdv_ligne_id), INDEX IDX_10C31F8635192D76 (rdv_eqipment_id), INDEX IDX_10C31F86501F9CEA (rdv_prestation_id), INDEX IDX_10C31F869395C3F3 (customer_id), INDEX IDX_10C31F862DFE895C (rdv_status_id), INDEX IDX_10C31F86B0D920B6 (rdv_motif_id), INDEX IDX_10C31F86183A4534 (rdv_zone_id), INDEX IDX_10C31F86BE3DB2B7 (prestataire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role_user (role_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_332CA4DDD60322AC (role_id), INDEX IDX_332CA4DDA76ED395 (user_id), PRIMARY KEY(role_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statut (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, ordre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, hash VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zone (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, code_postal VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, address VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE prestataire ADD CONSTRAINT FK_60A26480EA80731C FOREIGN KEY (prtaire_compc_id) REFERENCES competence (id)');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F86F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F863A7416D9 FOREIGN KEY (rdv_ligne_id) REFERENCES ligne (id)');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F8635192D76 FOREIGN KEY (rdv_eqipment_id) REFERENCES equipement (id)');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F86501F9CEA FOREIGN KEY (rdv_prestation_id) REFERENCES prestation (id)');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F869395C3F3 FOREIGN KEY (customer_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F862DFE895C FOREIGN KEY (rdv_status_id) REFERENCES statut (id)');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F86B0D920B6 FOREIGN KEY (rdv_motif_id) REFERENCES motif (id)');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F86183A4534 FOREIGN KEY (rdv_zone_id) REFERENCES zone (id)');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F86BE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id)');
        $this->addSql('ALTER TABLE role_user ADD CONSTRAINT FK_332CA4DDD60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_user ADD CONSTRAINT FK_332CA4DDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F869395C3F3');
        $this->addSql('ALTER TABLE prestataire DROP FOREIGN KEY FK_60A26480EA80731C');
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F8635192D76');
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F863A7416D9');
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F86B0D920B6');
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F86BE3DB2B7');
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F86501F9CEA');
        $this->addSql('ALTER TABLE role_user DROP FOREIGN KEY FK_332CA4DDD60322AC');
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F862DFE895C');
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F86F675F31B');
        $this->addSql('ALTER TABLE role_user DROP FOREIGN KEY FK_332CA4DDA76ED395');
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F86183A4534');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE competence');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE ligne');
        $this->addSql('DROP TABLE motif');
        $this->addSql('DROP TABLE prestataire');
        $this->addSql('DROP TABLE prestation');
        $this->addSql('DROP TABLE rdv');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE role_user');
        $this->addSql('DROP TABLE statut');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE zone');
    }
}
