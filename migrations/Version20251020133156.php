<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251020133156 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (id SERIAL NOT NULL, libelle VARCHAR(255) DEFAULT NULL, ligne1 VARCHAR(255) DEFAULT NULL, ligne2 VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(40) DEFAULT NULL, ville VARCHAR(120) DEFAULT NULL, region VARCHAR(120) DEFAULT NULL, pays VARCHAR(120) DEFAULT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE affaire (id SERIAL NOT NULL, client_id INT DEFAULT NULL, nom_affaire VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9C3F18EF19EB6921 ON affaire (client_id)');
        $this->addSql('CREATE TABLE agence (id SERIAL NOT NULL, adresse_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, designation VARCHAR(255) DEFAULT NULL, telephone VARCHAR(50) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_64C19AA94DE7DC5C ON agence (adresse_id)');
        $this->addSql('CREATE TABLE agence_membre (id SERIAL NOT NULL, agence_id INT NOT NULL, agent_matricule VARCHAR(20) NOT NULL, role VARCHAR(255) DEFAULT \'Membre\' NOT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1781E0DD725330D ON agence_membre (agence_id)');
        $this->addSql('CREATE INDEX IDX_1781E0DE5E65AD8 ON agence_membre (agent_matricule)');
        $this->addSql('CREATE UNIQUE INDEX agence_agent_unique ON agence_membre (agence_id, agent_matricule)');
        $this->addSql('CREATE TABLE agent (matricule VARCHAR(20) NOT NULL, agence_id INT NOT NULL, user_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) DEFAULT NULL, admin BOOLEAN DEFAULT false NOT NULL, email VARCHAR(255) NOT NULL, tel VARCHAR(50) DEFAULT NULL, actif BOOLEAN DEFAULT true NOT NULL, date_entree DATE DEFAULT NULL, commentaire TEXT DEFAULT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(matricule))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_268B9C9DE7927C74 ON agent (email)');
        $this->addSql('CREATE INDEX IDX_268B9C9DD725330D ON agent (agence_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_268B9C9DA76ED395 ON agent (user_id)');
        $this->addSql('CREATE TABLE agent_equipe (id SERIAL NOT NULL, agent_matricule VARCHAR(20) NOT NULL, equipe_id INT NOT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7AAEED33E5E65AD8 ON agent_equipe (agent_matricule)');
        $this->addSql('CREATE INDEX IDX_7AAEED336D861B89 ON agent_equipe (equipe_id)');
        $this->addSql('CREATE UNIQUE INDEX agent_equipe_unique ON agent_equipe (agent_matricule, equipe_id)');
        $this->addSql('CREATE TABLE agent_fonction (id SERIAL NOT NULL, agent_matricule VARCHAR(20) NOT NULL, fonction_id INT NOT NULL, principal BOOLEAN DEFAULT false NOT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3FD1CC29E5E65AD8 ON agent_fonction (agent_matricule)');
        $this->addSql('CREATE INDEX IDX_3FD1CC2957889920 ON agent_fonction (fonction_id)');
        $this->addSql('CREATE UNIQUE INDEX agent_fonction_unique ON agent_fonction (agent_matricule, fonction_id)');
        $this->addSql('CREATE TABLE client (id SERIAL NOT NULL, adresse_id INT DEFAULT NULL, nom_client VARCHAR(255) NOT NULL, representant_nom VARCHAR(255) DEFAULT NULL, representant_email VARCHAR(255) DEFAULT NULL, representant_tel VARCHAR(50) DEFAULT NULL, commentaire TEXT DEFAULT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C74404554DE7DC5C ON client (adresse_id)');
        $this->addSql('CREATE TABLE documents_repertoire (id SERIAL NOT NULL, auteur_matricule VARCHAR(20) DEFAULT NULL, cible_type VARCHAR(255) NOT NULL, cible_id VARCHAR(255) NOT NULL, nature VARCHAR(255) DEFAULT \'Document\' NOT NULL, nom_fichier VARCHAR(255) NOT NULL, type_mime VARCHAR(100) DEFAULT \'application/octet-stream\' NOT NULL, taille_octets BIGINT DEFAULT NULL, chemin_fichier VARCHAR(1024) DEFAULT NULL, checksum_sha256 VARCHAR(64) DEFAULT NULL, commentaire TEXT DEFAULT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C0EF291D8556E56 ON documents_repertoire (auteur_matricule)');
        $this->addSql('CREATE TABLE doe (id SERIAL NOT NULL, site_id INT NOT NULL, affaire_id INT NOT NULL, titre VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6F225851F6BD1646 ON doe (site_id)');
        $this->addSql('CREATE INDEX IDX_6F225851F082E755 ON doe (affaire_id)');
        $this->addSql('CREATE UNIQUE INDEX site_affaire_titre_unique ON doe (site_id, affaire_id, titre)');
        $this->addSql('CREATE TABLE equipe (id SERIAL NOT NULL, agence_id INT NOT NULL, nom VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2449BA15D725330D ON equipe (agence_id)');
        $this->addSql('CREATE TABLE fonction (id SERIAL NOT NULL, code VARCHAR(50) NOT NULL, libelle VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_900D5BD77153098 ON fonction (code)');
        $this->addSql('CREATE TABLE formation (id SERIAL NOT NULL, agent_matricule VARCHAR(20) NOT NULL, type VARCHAR(255) NOT NULL, libelle VARCHAR(255) NOT NULL, date_obtention DATE DEFAULT NULL, date_expiration DATE DEFAULT NULL, organisme VARCHAR(255) DEFAULT NULL, commentaire TEXT DEFAULT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_404021BFE5E65AD8 ON formation (agent_matricule)');
        $this->addSql('CREATE TABLE images (id SERIAL NOT NULL, auteur_matricule VARCHAR(20) DEFAULT NULL, nom_fichier VARCHAR(255) NOT NULL, type_mime VARCHAR(100) DEFAULT \'image/jpeg\' NOT NULL, taille_octets BIGINT NOT NULL, image_blob BYTEA NOT NULL, commentaire_image TEXT DEFAULT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E01FBE6A8556E56 ON images (auteur_matricule)');
        $this->addSql('CREATE TABLE intervention (id SERIAL NOT NULL, maintenance_id INT NOT NULL, intervention_precedente_id INT DEFAULT NULL, description TEXT NOT NULL, date_debut DATE NOT NULL, date_fin DATE DEFAULT NULL, date_debut_ts TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin_ts TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D11814ABF6C202BC ON intervention (maintenance_id)');
        $this->addSql('CREATE INDEX IDX_D11814AB48291676 ON intervention (intervention_precedente_id)');
        $this->addSql('CREATE TABLE maintenance (id SERIAL NOT NULL, doe_id INT NOT NULL, affaire_id INT NOT NULL, responsable VARCHAR(20) DEFAULT NULL, titre VARCHAR(255) DEFAULT NULL, description TEXT NOT NULL, etat VARCHAR(255) DEFAULT \'Pas_commence\' NOT NULL, motif_blocage TEXT DEFAULT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2F84F8E9AC3D1760 ON maintenance (doe_id)');
        $this->addSql('CREATE INDEX IDX_2F84F8E9F082E755 ON maintenance (affaire_id)');
        $this->addSql('CREATE INDEX IDX_2F84F8E952520D07 ON maintenance (responsable)');
        $this->addSql('CREATE TABLE passeport (id SERIAL NOT NULL, agent_matricule VARCHAR(20) NOT NULL, permis TEXT DEFAULT NULL, habilitations TEXT DEFAULT NULL, certifications TEXT DEFAULT NULL, commentaire TEXT DEFAULT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_69DAB86AE5E65AD8 ON passeport (agent_matricule)');
        $this->addSql('CREATE TABLE rapport_maintenance (id SERIAL NOT NULL, maintenance_id INT NOT NULL, matricule VARCHAR(20) NOT NULL, adresse_client_id INT DEFAULT NULL, date_rapport TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, nom_client VARCHAR(255) DEFAULT NULL, commentaire_interne TEXT DEFAULT NULL, materiel_commander TEXT DEFAULT NULL, etat VARCHAR(255) DEFAULT \'Pas_commence\' NOT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_82F068FF6C202BC ON rapport_maintenance (maintenance_id)');
        $this->addSql('CREATE INDEX IDX_82F068F12B2DC9C ON rapport_maintenance (matricule)');
        $this->addSql('CREATE INDEX IDX_82F068FB4ECFFF7 ON rapport_maintenance (adresse_client_id)');
        $this->addSql('CREATE TABLE rendez_vous_image (id SERIAL NOT NULL, rendez_vous_id INT NOT NULL, image_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_89DE2C8E91EF7EAA ON rendez_vous_image (rendez_vous_id)');
        $this->addSql('CREATE INDEX IDX_89DE2C8E3DA5256D ON rendez_vous_image (image_id)');
        $this->addSql('CREATE UNIQUE INDEX rendez_vous_image_unique ON rendez_vous_image (rendez_vous_id, image_id)');
        $this->addSql('CREATE TABLE rendezvous (id SERIAL NOT NULL, intervention_id INT DEFAULT NULL, site_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_fin TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, statut VARCHAR(50) NOT NULL, sujet VARCHAR(255) NOT NULL, date_rdv DATE NOT NULL, heure_rdv TIME(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C09A9BA88EAE3863 ON rendezvous (intervention_id)');
        $this->addSql('CREATE INDEX IDX_C09A9BA8F6BD1646 ON rendezvous (site_id)');
        $this->addSql('CREATE TABLE rendu_intervention (id SERIAL NOT NULL, intervention_id INT NOT NULL, resume TEXT DEFAULT NULL, valeur TEXT DEFAULT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_17963D008EAE3863 ON rendu_intervention (intervention_id)');
        $this->addSql('CREATE TABLE rendu_intervention_image (id SERIAL NOT NULL, rendu_intervention_id INT NOT NULL, image_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_97F69F7915C5BBE8 ON rendu_intervention_image (rendu_intervention_id)');
        $this->addSql('CREATE INDEX IDX_97F69F793DA5256D ON rendu_intervention_image (image_id)');
        $this->addSql('CREATE UNIQUE INDEX rendu_intervention_image_unique ON rendu_intervention_image (rendu_intervention_id, image_id)');
        $this->addSql('CREATE TABLE site (id SERIAL NOT NULL, adresse_id INT DEFAULT NULL, nom_site VARCHAR(255) NOT NULL, commentaire TEXT DEFAULT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_694309E44DE7DC5C ON site (adresse_id)');
        $this->addSql('CREATE TABLE site_affaire (id SERIAL NOT NULL, site_id INT NOT NULL, affaire_id INT NOT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_679BFA24F6BD1646 ON site_affaire (site_id)');
        $this->addSql('CREATE INDEX IDX_679BFA24F082E755 ON site_affaire (affaire_id)');
        $this->addSql('CREATE UNIQUE INDEX site_affaire_unique ON site_affaire (site_id, affaire_id)');
        $this->addSql('CREATE TABLE users (id SERIAL NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE affaire ADD CONSTRAINT FK_9C3F18EF19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE agence ADD CONSTRAINT FK_64C19AA94DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE agence_membre ADD CONSTRAINT FK_1781E0DD725330D FOREIGN KEY (agence_id) REFERENCES agence (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE agence_membre ADD CONSTRAINT FK_1781E0DE5E65AD8 FOREIGN KEY (agent_matricule) REFERENCES agent (matricule) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE agent ADD CONSTRAINT FK_268B9C9DD725330D FOREIGN KEY (agence_id) REFERENCES agence (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE agent ADD CONSTRAINT FK_268B9C9DA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE agent_equipe ADD CONSTRAINT FK_7AAEED33E5E65AD8 FOREIGN KEY (agent_matricule) REFERENCES agent (matricule) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE agent_equipe ADD CONSTRAINT FK_7AAEED336D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE agent_fonction ADD CONSTRAINT FK_3FD1CC29E5E65AD8 FOREIGN KEY (agent_matricule) REFERENCES agent (matricule) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE agent_fonction ADD CONSTRAINT FK_3FD1CC2957889920 FOREIGN KEY (fonction_id) REFERENCES fonction (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C74404554DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE documents_repertoire ADD CONSTRAINT FK_C0EF291D8556E56 FOREIGN KEY (auteur_matricule) REFERENCES agent (matricule) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE doe ADD CONSTRAINT FK_6F225851F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE doe ADD CONSTRAINT FK_6F225851F082E755 FOREIGN KEY (affaire_id) REFERENCES affaire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15D725330D FOREIGN KEY (agence_id) REFERENCES agence (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BFE5E65AD8 FOREIGN KEY (agent_matricule) REFERENCES agent (matricule) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A8556E56 FOREIGN KEY (auteur_matricule) REFERENCES agent (matricule) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT FK_D11814ABF6C202BC FOREIGN KEY (maintenance_id) REFERENCES maintenance (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT FK_D11814AB48291676 FOREIGN KEY (intervention_precedente_id) REFERENCES intervention (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE maintenance ADD CONSTRAINT FK_2F84F8E9AC3D1760 FOREIGN KEY (doe_id) REFERENCES doe (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE maintenance ADD CONSTRAINT FK_2F84F8E9F082E755 FOREIGN KEY (affaire_id) REFERENCES affaire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE maintenance ADD CONSTRAINT FK_2F84F8E952520D07 FOREIGN KEY (responsable) REFERENCES agent (matricule) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE passeport ADD CONSTRAINT FK_69DAB86AE5E65AD8 FOREIGN KEY (agent_matricule) REFERENCES agent (matricule) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rapport_maintenance ADD CONSTRAINT FK_82F068FF6C202BC FOREIGN KEY (maintenance_id) REFERENCES maintenance (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rapport_maintenance ADD CONSTRAINT FK_82F068F12B2DC9C FOREIGN KEY (matricule) REFERENCES agent (matricule) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rapport_maintenance ADD CONSTRAINT FK_82F068FB4ECFFF7 FOREIGN KEY (adresse_client_id) REFERENCES adresse (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rendez_vous_image ADD CONSTRAINT FK_89DE2C8E91EF7EAA FOREIGN KEY (rendez_vous_id) REFERENCES rendezvous (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rendez_vous_image ADD CONSTRAINT FK_89DE2C8E3DA5256D FOREIGN KEY (image_id) REFERENCES images (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA88EAE3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA8F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rendu_intervention ADD CONSTRAINT FK_17963D008EAE3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rendu_intervention_image ADD CONSTRAINT FK_97F69F7915C5BBE8 FOREIGN KEY (rendu_intervention_id) REFERENCES rendu_intervention (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rendu_intervention_image ADD CONSTRAINT FK_97F69F793DA5256D FOREIGN KEY (image_id) REFERENCES images (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE site ADD CONSTRAINT FK_694309E44DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE site_affaire ADD CONSTRAINT FK_679BFA24F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE site_affaire ADD CONSTRAINT FK_679BFA24F082E755 FOREIGN KEY (affaire_id) REFERENCES affaire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE affaire DROP CONSTRAINT FK_9C3F18EF19EB6921');
        $this->addSql('ALTER TABLE agence DROP CONSTRAINT FK_64C19AA94DE7DC5C');
        $this->addSql('ALTER TABLE agence_membre DROP CONSTRAINT FK_1781E0DD725330D');
        $this->addSql('ALTER TABLE agence_membre DROP CONSTRAINT FK_1781E0DE5E65AD8');
        $this->addSql('ALTER TABLE agent DROP CONSTRAINT FK_268B9C9DD725330D');
        $this->addSql('ALTER TABLE agent DROP CONSTRAINT FK_268B9C9DA76ED395');
        $this->addSql('ALTER TABLE agent_equipe DROP CONSTRAINT FK_7AAEED33E5E65AD8');
        $this->addSql('ALTER TABLE agent_equipe DROP CONSTRAINT FK_7AAEED336D861B89');
        $this->addSql('ALTER TABLE agent_fonction DROP CONSTRAINT FK_3FD1CC29E5E65AD8');
        $this->addSql('ALTER TABLE agent_fonction DROP CONSTRAINT FK_3FD1CC2957889920');
        $this->addSql('ALTER TABLE client DROP CONSTRAINT FK_C74404554DE7DC5C');
        $this->addSql('ALTER TABLE documents_repertoire DROP CONSTRAINT FK_C0EF291D8556E56');
        $this->addSql('ALTER TABLE doe DROP CONSTRAINT FK_6F225851F6BD1646');
        $this->addSql('ALTER TABLE doe DROP CONSTRAINT FK_6F225851F082E755');
        $this->addSql('ALTER TABLE equipe DROP CONSTRAINT FK_2449BA15D725330D');
        $this->addSql('ALTER TABLE formation DROP CONSTRAINT FK_404021BFE5E65AD8');
        $this->addSql('ALTER TABLE images DROP CONSTRAINT FK_E01FBE6A8556E56');
        $this->addSql('ALTER TABLE intervention DROP CONSTRAINT FK_D11814ABF6C202BC');
        $this->addSql('ALTER TABLE intervention DROP CONSTRAINT FK_D11814AB48291676');
        $this->addSql('ALTER TABLE maintenance DROP CONSTRAINT FK_2F84F8E9AC3D1760');
        $this->addSql('ALTER TABLE maintenance DROP CONSTRAINT FK_2F84F8E9F082E755');
        $this->addSql('ALTER TABLE maintenance DROP CONSTRAINT FK_2F84F8E952520D07');
        $this->addSql('ALTER TABLE passeport DROP CONSTRAINT FK_69DAB86AE5E65AD8');
        $this->addSql('ALTER TABLE rapport_maintenance DROP CONSTRAINT FK_82F068FF6C202BC');
        $this->addSql('ALTER TABLE rapport_maintenance DROP CONSTRAINT FK_82F068F12B2DC9C');
        $this->addSql('ALTER TABLE rapport_maintenance DROP CONSTRAINT FK_82F068FB4ECFFF7');
        $this->addSql('ALTER TABLE rendez_vous_image DROP CONSTRAINT FK_89DE2C8E91EF7EAA');
        $this->addSql('ALTER TABLE rendez_vous_image DROP CONSTRAINT FK_89DE2C8E3DA5256D');
        $this->addSql('ALTER TABLE rendezvous DROP CONSTRAINT FK_C09A9BA88EAE3863');
        $this->addSql('ALTER TABLE rendezvous DROP CONSTRAINT FK_C09A9BA8F6BD1646');
        $this->addSql('ALTER TABLE rendu_intervention DROP CONSTRAINT FK_17963D008EAE3863');
        $this->addSql('ALTER TABLE rendu_intervention_image DROP CONSTRAINT FK_97F69F7915C5BBE8');
        $this->addSql('ALTER TABLE rendu_intervention_image DROP CONSTRAINT FK_97F69F793DA5256D');
        $this->addSql('ALTER TABLE site DROP CONSTRAINT FK_694309E44DE7DC5C');
        $this->addSql('ALTER TABLE site_affaire DROP CONSTRAINT FK_679BFA24F6BD1646');
        $this->addSql('ALTER TABLE site_affaire DROP CONSTRAINT FK_679BFA24F082E755');
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
        $this->addSql('DROP TABLE rendez_vous_image');
        $this->addSql('DROP TABLE rendezvous');
        $this->addSql('DROP TABLE rendu_intervention');
        $this->addSql('DROP TABLE rendu_intervention_image');
        $this->addSql('DROP TABLE site');
        $this->addSql('DROP TABLE site_affaire');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
