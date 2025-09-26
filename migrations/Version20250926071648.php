<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250926071648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) DEFAULT NULL, ligne1 VARCHAR(255) DEFAULT NULL, ligne2 VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(40) DEFAULT NULL, ville VARCHAR(120) DEFAULT NULL, region VARCHAR(120) DEFAULT NULL, pays VARCHAR(120) DEFAULT NULL, date_debut DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE affaire (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, nom_affaire VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, date_debut DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_9C3F18EF19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agence (id INT AUTO_INCREMENT NOT NULL, adresse_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, designation VARCHAR(255) DEFAULT NULL, telephone VARCHAR(50) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, date_debut DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_64C19AA94DE7DC5C (adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agence_membre (id INT AUTO_INCREMENT NOT NULL, agence_id INT NOT NULL, agent_matricule VARCHAR(20) NOT NULL, role VARCHAR(255) DEFAULT \'Membre\' NOT NULL, date_debut DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_1781E0DD725330D (agence_id), INDEX IDX_1781E0DE5E65AD8 (agent_matricule), UNIQUE INDEX agence_agent_unique (agence_id, agent_matricule), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agent (matricule VARCHAR(20) NOT NULL, agence_id INT NOT NULL, user_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) DEFAULT NULL, `admin` TINYINT(1) DEFAULT 0 NOT NULL, email VARCHAR(255) NOT NULL, tel VARCHAR(50) DEFAULT NULL, actif TINYINT(1) DEFAULT 1 NOT NULL, date_entree DATE DEFAULT NULL, commentaire LONGTEXT DEFAULT NULL, date_debut DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, UNIQUE INDEX UNIQ_268B9C9DE7927C74 (email), INDEX IDX_268B9C9DD725330D (agence_id), UNIQUE INDEX UNIQ_268B9C9DA76ED395 (user_id), PRIMARY KEY(matricule)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agent_equipe (id INT AUTO_INCREMENT NOT NULL, agent_matricule VARCHAR(20) NOT NULL, equipe_id INT NOT NULL, date_debut DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_7AAEED33E5E65AD8 (agent_matricule), INDEX IDX_7AAEED336D861B89 (equipe_id), UNIQUE INDEX agent_equipe_unique (agent_matricule, equipe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agent_fonction (id INT AUTO_INCREMENT NOT NULL, agent_matricule VARCHAR(20) NOT NULL, fonction_id INT NOT NULL, principal TINYINT(1) DEFAULT 0 NOT NULL, date_debut DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_3FD1CC29E5E65AD8 (agent_matricule), INDEX IDX_3FD1CC2957889920 (fonction_id), UNIQUE INDEX agent_fonction_unique (agent_matricule, fonction_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, adresse_id INT DEFAULT NULL, nom_client VARCHAR(255) NOT NULL, representant_nom VARCHAR(255) DEFAULT NULL, representant_email VARCHAR(255) DEFAULT NULL, representant_tel VARCHAR(50) DEFAULT NULL, commentaire LONGTEXT DEFAULT NULL, date_debut DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_C74404554DE7DC5C (adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE documents_repertoire (id INT AUTO_INCREMENT NOT NULL, auteur_matricule VARCHAR(20) DEFAULT NULL, cible_type VARCHAR(255) NOT NULL, cible_id VARCHAR(255) NOT NULL, nature VARCHAR(255) DEFAULT \'Document\' NOT NULL, nom_fichier VARCHAR(255) NOT NULL, type_mime VARCHAR(100) DEFAULT \'application/octet-stream\' NOT NULL, taille_octets BIGINT DEFAULT NULL, chemin_fichier VARCHAR(1024) DEFAULT NULL, checksum_sha256 VARCHAR(64) DEFAULT NULL, commentaire LONGTEXT DEFAULT NULL, date_debut DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_C0EF291D8556E56 (auteur_matricule), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE doe (id INT AUTO_INCREMENT NOT NULL, site_id INT NOT NULL, affaire_id INT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, date_debut DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_6F225851F6BD1646 (site_id), INDEX IDX_6F225851F082E755 (affaire_id), UNIQUE INDEX site_affaire_titre_unique (site_id, affaire_id, titre), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipe (id INT AUTO_INCREMENT NOT NULL, agence_id INT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, date_debut DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_2449BA15D725330D (agence_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fonction (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(50) NOT NULL, libelle VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, date_debut DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, UNIQUE INDEX UNIQ_900D5BD77153098 (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, agent_matricule VARCHAR(20) NOT NULL, type VARCHAR(255) NOT NULL, libelle VARCHAR(255) NOT NULL, date_obtention DATE DEFAULT NULL, date_expiration DATE DEFAULT NULL, organisme VARCHAR(255) DEFAULT NULL, commentaire LONGTEXT DEFAULT NULL, date_debut DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_404021BFE5E65AD8 (agent_matricule), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, auteur_matricule VARCHAR(20) DEFAULT NULL, nom_fichier VARCHAR(255) NOT NULL, type_mime VARCHAR(100) DEFAULT \'image/jpeg\' NOT NULL, taille_octets BIGINT NOT NULL, image_blob LONGBLOB NOT NULL, commentaire_image LONGTEXT DEFAULT NULL, date_debut DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_E01FBE6A8556E56 (auteur_matricule), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intervention (id INT AUTO_INCREMENT NOT NULL, maintenance_id INT NOT NULL, intervention_precedente_id INT DEFAULT NULL, description LONGTEXT NOT NULL, date_debut DATE NOT NULL, date_fin DATE DEFAULT NULL, date_debut_ts DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin_ts DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_D11814ABF6C202BC (maintenance_id), INDEX IDX_D11814AB48291676 (intervention_precedente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maintenance (id INT AUTO_INCREMENT NOT NULL, doe_id INT NOT NULL, affaire_id INT NOT NULL, responsable VARCHAR(20) DEFAULT NULL, titre VARCHAR(255) DEFAULT NULL, description LONGTEXT NOT NULL, etat VARCHAR(255) DEFAULT \'Pas_commence\' NOT NULL, motif_blocage LONGTEXT DEFAULT NULL, date_debut DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_2F84F8E9AC3D1760 (doe_id), INDEX IDX_2F84F8E9F082E755 (affaire_id), INDEX IDX_2F84F8E952520D07 (responsable), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE passeport (id INT AUTO_INCREMENT NOT NULL, agent_matricule VARCHAR(20) NOT NULL, permis LONGTEXT DEFAULT NULL, habilitations LONGTEXT DEFAULT NULL, certifications LONGTEXT DEFAULT NULL, commentaire LONGTEXT DEFAULT NULL, date_debut DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_69DAB86AE5E65AD8 (agent_matricule), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rapport_maintenance (id INT AUTO_INCREMENT NOT NULL, maintenance_id INT NOT NULL, matricule VARCHAR(20) NOT NULL, adresse_client_id INT DEFAULT NULL, date_rapport DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, nom_client VARCHAR(255) DEFAULT NULL, commentaire_interne LONGTEXT DEFAULT NULL, materiel_commander LONGTEXT DEFAULT NULL, etat VARCHAR(255) DEFAULT \'Pas_commence\' NOT NULL, date_debut DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_82F068FF6C202BC (maintenance_id), INDEX IDX_82F068F12B2DC9C (matricule), INDEX IDX_82F068FB4ECFFF7 (adresse_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rendez_vous (id INT AUTO_INCREMENT NOT NULL, site_id INT NOT NULL, intervention_id INT DEFAULT NULL, sujet VARCHAR(255) NOT NULL, date_rdv DATE NOT NULL, heure_rdv TIME DEFAULT NULL, description LONGTEXT DEFAULT NULL, statut VARCHAR(255) DEFAULT \'Planifie\' NOT NULL, date_debut DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_65E8AA0AF6BD1646 (site_id), INDEX IDX_65E8AA0A8EAE3863 (intervention_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rendez_vous_image (id INT AUTO_INCREMENT NOT NULL, rendez_vous_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_89DE2C8E91EF7EAA (rendez_vous_id), INDEX IDX_89DE2C8E3DA5256D (image_id), UNIQUE INDEX rendez_vous_image_unique (rendez_vous_id, image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rendu_intervention (id INT AUTO_INCREMENT NOT NULL, intervention_id INT NOT NULL, resume LONGTEXT DEFAULT NULL, valeur LONGTEXT DEFAULT NULL, date_debut DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_17963D008EAE3863 (intervention_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rendu_intervention_image (id INT AUTO_INCREMENT NOT NULL, rendu_intervention_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_97F69F7915C5BBE8 (rendu_intervention_id), INDEX IDX_97F69F793DA5256D (image_id), UNIQUE INDEX rendu_intervention_image_unique (rendu_intervention_id, image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE site (id INT AUTO_INCREMENT NOT NULL, adresse_id INT DEFAULT NULL, nom_site VARCHAR(255) NOT NULL, commentaire LONGTEXT DEFAULT NULL, date_debut DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_694309E44DE7DC5C (adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE site_affaire (id INT AUTO_INCREMENT NOT NULL, site_id INT NOT NULL, affaire_id INT NOT NULL, date_debut DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_679BFA24F6BD1646 (site_id), INDEX IDX_679BFA24F082E755 (affaire_id), UNIQUE INDEX site_affaire_unique (site_id, affaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE affaire ADD CONSTRAINT FK_9C3F18EF19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE agence ADD CONSTRAINT FK_64C19AA94DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE agence_membre ADD CONSTRAINT FK_1781E0DD725330D FOREIGN KEY (agence_id) REFERENCES agence (id)');
        $this->addSql('ALTER TABLE agence_membre ADD CONSTRAINT FK_1781E0DE5E65AD8 FOREIGN KEY (agent_matricule) REFERENCES agent (matricule)');
        $this->addSql('ALTER TABLE agent ADD CONSTRAINT FK_268B9C9DD725330D FOREIGN KEY (agence_id) REFERENCES agence (id)');
        $this->addSql('ALTER TABLE agent ADD CONSTRAINT FK_268B9C9DA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE agent_equipe ADD CONSTRAINT FK_7AAEED33E5E65AD8 FOREIGN KEY (agent_matricule) REFERENCES agent (matricule)');
        $this->addSql('ALTER TABLE agent_equipe ADD CONSTRAINT FK_7AAEED336D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE agent_fonction ADD CONSTRAINT FK_3FD1CC29E5E65AD8 FOREIGN KEY (agent_matricule) REFERENCES agent (matricule)');
        $this->addSql('ALTER TABLE agent_fonction ADD CONSTRAINT FK_3FD1CC2957889920 FOREIGN KEY (fonction_id) REFERENCES fonction (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C74404554DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE documents_repertoire ADD CONSTRAINT FK_C0EF291D8556E56 FOREIGN KEY (auteur_matricule) REFERENCES agent (matricule)');
        $this->addSql('ALTER TABLE doe ADD CONSTRAINT FK_6F225851F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id)');
        $this->addSql('ALTER TABLE doe ADD CONSTRAINT FK_6F225851F082E755 FOREIGN KEY (affaire_id) REFERENCES affaire (id)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15D725330D FOREIGN KEY (agence_id) REFERENCES agence (id)');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BFE5E65AD8 FOREIGN KEY (agent_matricule) REFERENCES agent (matricule)');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A8556E56 FOREIGN KEY (auteur_matricule) REFERENCES agent (matricule)');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT FK_D11814ABF6C202BC FOREIGN KEY (maintenance_id) REFERENCES maintenance (id)');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT FK_D11814AB48291676 FOREIGN KEY (intervention_precedente_id) REFERENCES intervention (id)');
        $this->addSql('ALTER TABLE maintenance ADD CONSTRAINT FK_2F84F8E9AC3D1760 FOREIGN KEY (doe_id) REFERENCES doe (id)');
        $this->addSql('ALTER TABLE maintenance ADD CONSTRAINT FK_2F84F8E9F082E755 FOREIGN KEY (affaire_id) REFERENCES affaire (id)');
        $this->addSql('ALTER TABLE maintenance ADD CONSTRAINT FK_2F84F8E952520D07 FOREIGN KEY (responsable) REFERENCES agent (matricule)');
        $this->addSql('ALTER TABLE passeport ADD CONSTRAINT FK_69DAB86AE5E65AD8 FOREIGN KEY (agent_matricule) REFERENCES agent (matricule)');
        $this->addSql('ALTER TABLE rapport_maintenance ADD CONSTRAINT FK_82F068FF6C202BC FOREIGN KEY (maintenance_id) REFERENCES maintenance (id)');
        $this->addSql('ALTER TABLE rapport_maintenance ADD CONSTRAINT FK_82F068F12B2DC9C FOREIGN KEY (matricule) REFERENCES agent (matricule)');
        $this->addSql('ALTER TABLE rapport_maintenance ADD CONSTRAINT FK_82F068FB4ECFFF7 FOREIGN KEY (adresse_client_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE rendez_vous ADD CONSTRAINT FK_65E8AA0AF6BD1646 FOREIGN KEY (site_id) REFERENCES site (id)');
        $this->addSql('ALTER TABLE rendez_vous ADD CONSTRAINT FK_65E8AA0A8EAE3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id)');
        $this->addSql('ALTER TABLE rendez_vous_image ADD CONSTRAINT FK_89DE2C8E91EF7EAA FOREIGN KEY (rendez_vous_id) REFERENCES rendez_vous (id)');
        $this->addSql('ALTER TABLE rendez_vous_image ADD CONSTRAINT FK_89DE2C8E3DA5256D FOREIGN KEY (image_id) REFERENCES images (id)');
        $this->addSql('ALTER TABLE rendu_intervention ADD CONSTRAINT FK_17963D008EAE3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id)');
        $this->addSql('ALTER TABLE rendu_intervention_image ADD CONSTRAINT FK_97F69F7915C5BBE8 FOREIGN KEY (rendu_intervention_id) REFERENCES rendu_intervention (id)');
        $this->addSql('ALTER TABLE rendu_intervention_image ADD CONSTRAINT FK_97F69F793DA5256D FOREIGN KEY (image_id) REFERENCES images (id)');
        $this->addSql('ALTER TABLE site ADD CONSTRAINT FK_694309E44DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE site_affaire ADD CONSTRAINT FK_679BFA24F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id)');
        $this->addSql('ALTER TABLE site_affaire ADD CONSTRAINT FK_679BFA24F082E755 FOREIGN KEY (affaire_id) REFERENCES affaire (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE affaire DROP FOREIGN KEY FK_9C3F18EF19EB6921');
        $this->addSql('ALTER TABLE agence DROP FOREIGN KEY FK_64C19AA94DE7DC5C');
        $this->addSql('ALTER TABLE agence_membre DROP FOREIGN KEY FK_1781E0DD725330D');
        $this->addSql('ALTER TABLE agence_membre DROP FOREIGN KEY FK_1781E0DE5E65AD8');
        $this->addSql('ALTER TABLE agent DROP FOREIGN KEY FK_268B9C9DD725330D');
        $this->addSql('ALTER TABLE agent DROP FOREIGN KEY FK_268B9C9DA76ED395');
        $this->addSql('ALTER TABLE agent_equipe DROP FOREIGN KEY FK_7AAEED33E5E65AD8');
        $this->addSql('ALTER TABLE agent_equipe DROP FOREIGN KEY FK_7AAEED336D861B89');
        $this->addSql('ALTER TABLE agent_fonction DROP FOREIGN KEY FK_3FD1CC29E5E65AD8');
        $this->addSql('ALTER TABLE agent_fonction DROP FOREIGN KEY FK_3FD1CC2957889920');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C74404554DE7DC5C');
        $this->addSql('ALTER TABLE documents_repertoire DROP FOREIGN KEY FK_C0EF291D8556E56');
        $this->addSql('ALTER TABLE doe DROP FOREIGN KEY FK_6F225851F6BD1646');
        $this->addSql('ALTER TABLE doe DROP FOREIGN KEY FK_6F225851F082E755');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15D725330D');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BFE5E65AD8');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A8556E56');
        $this->addSql('ALTER TABLE intervention DROP FOREIGN KEY FK_D11814ABF6C202BC');
        $this->addSql('ALTER TABLE intervention DROP FOREIGN KEY FK_D11814AB48291676');
        $this->addSql('ALTER TABLE maintenance DROP FOREIGN KEY FK_2F84F8E9AC3D1760');
        $this->addSql('ALTER TABLE maintenance DROP FOREIGN KEY FK_2F84F8E9F082E755');
        $this->addSql('ALTER TABLE maintenance DROP FOREIGN KEY FK_2F84F8E952520D07');
        $this->addSql('ALTER TABLE passeport DROP FOREIGN KEY FK_69DAB86AE5E65AD8');
        $this->addSql('ALTER TABLE rapport_maintenance DROP FOREIGN KEY FK_82F068FF6C202BC');
        $this->addSql('ALTER TABLE rapport_maintenance DROP FOREIGN KEY FK_82F068F12B2DC9C');
        $this->addSql('ALTER TABLE rapport_maintenance DROP FOREIGN KEY FK_82F068FB4ECFFF7');
        $this->addSql('ALTER TABLE rendez_vous DROP FOREIGN KEY FK_65E8AA0AF6BD1646');
        $this->addSql('ALTER TABLE rendez_vous DROP FOREIGN KEY FK_65E8AA0A8EAE3863');
        $this->addSql('ALTER TABLE rendez_vous_image DROP FOREIGN KEY FK_89DE2C8E91EF7EAA');
        $this->addSql('ALTER TABLE rendez_vous_image DROP FOREIGN KEY FK_89DE2C8E3DA5256D');
        $this->addSql('ALTER TABLE rendu_intervention DROP FOREIGN KEY FK_17963D008EAE3863');
        $this->addSql('ALTER TABLE rendu_intervention_image DROP FOREIGN KEY FK_97F69F7915C5BBE8');
        $this->addSql('ALTER TABLE rendu_intervention_image DROP FOREIGN KEY FK_97F69F793DA5256D');
        $this->addSql('ALTER TABLE site DROP FOREIGN KEY FK_694309E44DE7DC5C');
        $this->addSql('ALTER TABLE site_affaire DROP FOREIGN KEY FK_679BFA24F6BD1646');
        $this->addSql('ALTER TABLE site_affaire DROP FOREIGN KEY FK_679BFA24F082E755');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE affaire');
        $this->addSql('DROP TABLE agence');
        $this->addSql('DROP TABLE agence_membre');
        $this->addSql('DROP TABLE agent');
        $this->addSql('DROP TABLE agent_equipe');
        $this->addSql('DROP TABLE agent_fonction');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE documents_repertoire');
        $this->addSql('DROP TABLE doe');
        $this->addSql('DROP TABLE equipe');
        $this->addSql('DROP TABLE fonction');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE images');
        $this->addSql('DROP TABLE intervention');
        $this->addSql('DROP TABLE maintenance');
        $this->addSql('DROP TABLE passeport');
        $this->addSql('DROP TABLE rapport_maintenance');
        $this->addSql('DROP TABLE rendez_vous');
        $this->addSql('DROP TABLE rendez_vous_image');
        $this->addSql('DROP TABLE rendu_intervention');
        $this->addSql('DROP TABLE rendu_intervention_image');
        $this->addSql('DROP TABLE site');
        $this->addSql('DROP TABLE site_affaire');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
