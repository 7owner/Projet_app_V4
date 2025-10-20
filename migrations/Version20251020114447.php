<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251020114447 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE cars_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE achat_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE facture_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reglement_id_seq CASCADE');
        $this->addSql('ALTER TABLE achat DROP CONSTRAINT fk_achat_affaire');
        $this->addSql('ALTER TABLE achat DROP CONSTRAINT fk_achat_site');
        $this->addSql('ALTER TABLE reglement DROP CONSTRAINT fk_reglement_facture');
        $this->addSql('ALTER TABLE facture DROP CONSTRAINT fk_facture_affaire');
        $this->addSql('ALTER TABLE facture DROP CONSTRAINT fk_facture_client');
        $this->addSql('DROP TABLE achat');
        $this->addSql('DROP TABLE cars');
        $this->addSql('DROP TABLE reglement');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP INDEX idx_affaire_client');
        $this->addSql('ALTER TABLE agence DROP CONSTRAINT fk_agence_adresse');
        $this->addSql('ALTER TABLE agence_membre DROP CONSTRAINT fk_agence_membre_agence');
        $this->addSql('ALTER TABLE agence_membre DROP CONSTRAINT fk_agence_membre_agent');
        $this->addSql('DROP INDEX idx_agence_membre_agence');
        $this->addSql('DROP INDEX idx_agence_membre_agent');
        $this->addSql('DROP INDEX uq_agence_membre');
        $this->addSql('ALTER TABLE agent DROP CONSTRAINT fk_agent_agence');
        $this->addSql('ALTER TABLE agent DROP CONSTRAINT fk_agent_user');
        $this->addSql('ALTER TABLE agent_equipe DROP CONSTRAINT fk_agent_equipe_agent');
        $this->addSql('ALTER TABLE agent_equipe DROP CONSTRAINT fk_agent_equipe_equipe');
        $this->addSql('DROP INDEX idx_agent_equipe_agent');
        $this->addSql('DROP INDEX idx_agent_equipe_equipe');
        $this->addSql('DROP INDEX uq_agent_equipe');
        $this->addSql('ALTER TABLE agent_fonction DROP CONSTRAINT fk_agent_fonction_agent');
        $this->addSql('ALTER TABLE agent_fonction DROP CONSTRAINT fk_agent_fonction_fonction');
        $this->addSql('DROP INDEX idx_agent_fonction_fonction');
        $this->addSql('DROP INDEX uq_agent_fonction');
        $this->addSql('ALTER TABLE client DROP CONSTRAINT fk_client_adresse');
        $this->addSql('ALTER TABLE documents_repertoire DROP CONSTRAINT fk_docs_auteur');
        $this->addSql('DROP INDEX idx_docs_checksum');
        $this->addSql('DROP INDEX idx_docs_cible');
        $this->addSql('DROP INDEX idx_docs_nom');
        $this->addSql('ALTER TABLE doe DROP CONSTRAINT fk_doe_affaire');
        $this->addSql('ALTER TABLE doe DROP CONSTRAINT fk_doe_site');
        $this->addSql('DROP INDEX idx_doe_affaire');
        $this->addSql('DROP INDEX idx_doe_site');
        $this->addSql('ALTER TABLE equipe DROP CONSTRAINT fk_equipe_agence');
        $this->addSql('DROP INDEX idx_equipe_agence');
        $this->addSql('DROP INDEX uq_fonction_code');
        $this->addSql('ALTER TABLE formation DROP CONSTRAINT fk_formation_agent');
        $this->addSql('DROP INDEX idx_formation_agent');
        $this->addSql('DROP INDEX idx_formation_expiration');
        $this->addSql('ALTER TABLE images DROP CONSTRAINT fk_images_auteur');
        $this->addSql('DROP INDEX idx_images_auteur');
        $this->addSql('DROP INDEX idx_images_target');
        $this->addSql('ALTER TABLE images DROP cible_type');
        $this->addSql('ALTER TABLE images DROP cible_id');
        $this->addSql('ALTER TABLE intervention DROP CONSTRAINT fk_intervention_maintenance');
        $this->addSql('ALTER TABLE intervention DROP CONSTRAINT fk_intervention_prec');
        $this->addSql('ALTER TABLE maintenance DROP CONSTRAINT fk_maintenance_affaire');
        $this->addSql('ALTER TABLE maintenance DROP CONSTRAINT fk_maintenance_doe');
        $this->addSql('DROP INDEX idx_maintenance_affaire');
        $this->addSql('DROP INDEX idx_maintenance_doe');
        $this->addSql('DROP INDEX idx_maintenance_etat');
        $this->addSql('ALTER TABLE passeport DROP CONSTRAINT fk_passeport_agent');
        $this->addSql('DROP INDEX uq_passeport_agent');
        $this->addSql('ALTER TABLE rapport_maintenance DROP CONSTRAINT fk_rapport_maintenance_adresse');
        $this->addSql('ALTER TABLE rapport_maintenance DROP CONSTRAINT fk_rapport_maintenance_agent');
        $this->addSql('ALTER TABLE rapport_maintenance DROP CONSTRAINT fk_rapport_maintenance_maintenance');
        $this->addSql('DROP INDEX idx_rapport_maintenance');
        $this->addSql('DROP INDEX idx_rapport_maintenance_date');
        $this->addSql('DROP INDEX idx_rapport_maintenance_etat');
        $this->addSql('ALTER TABLE rendezvous DROP CONSTRAINT fk_rendezvous_intervention');
        $this->addSql('ALTER TABLE rendezvous DROP CONSTRAINT fk_rendezvous_site');
        $this->addSql('ALTER TABLE site DROP CONSTRAINT fk_site_adresse');
        $this->addSql('ALTER TABLE site_affaire DROP CONSTRAINT fk_site_affaire_affaire');
        $this->addSql('ALTER TABLE site_affaire DROP CONSTRAINT fk_site_affaire_site');
        $this->addSql('DROP INDEX uq_site_affaire');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE cars_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE achat_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE facture_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reglement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE achat (id SERIAL NOT NULL, affaire_id BIGINT DEFAULT NULL, site_id BIGINT DEFAULT NULL, reference VARCHAR(100) DEFAULT NULL, objet VARCHAR(255) DEFAULT NULL, fournisseur VARCHAR(255) DEFAULT NULL, statut VARCHAR(50) DEFAULT \'Brouillon\' NOT NULL, montant_ht NUMERIC(12, 2) DEFAULT NULL, tva NUMERIC(5, 2) DEFAULT NULL, montant_ttc NUMERIC(12, 2) DEFAULT NULL, date_commande DATE DEFAULT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_achat_affaire ON achat (affaire_id)');
        $this->addSql('CREATE INDEX idx_achat_site ON achat (site_id)');
        $this->addSql('CREATE INDEX idx_achat_statut ON achat (statut)');
        $this->addSql('CREATE TABLE cars (id SERIAL NOT NULL, make VARCHAR(255) NOT NULL, model VARCHAR(255) NOT NULL, year INT NOT NULL, color VARCHAR(50) DEFAULT NULL, price_per_day NUMERIC(10, 2) NOT NULL, available BOOLEAN DEFAULT true NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE reglement (id SERIAL NOT NULL, facture_id BIGINT NOT NULL, montant NUMERIC(12, 2) NOT NULL, mode VARCHAR(50) DEFAULT \'Virement\' NOT NULL, reference VARCHAR(100) DEFAULT NULL, date_reglement DATE DEFAULT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_reglement_facture ON reglement (facture_id)');
        $this->addSql('CREATE INDEX idx_reglement_mode ON reglement (mode)');
        $this->addSql('CREATE TABLE facture (id SERIAL NOT NULL, client_id BIGINT DEFAULT NULL, affaire_id BIGINT DEFAULT NULL, reference VARCHAR(100) DEFAULT NULL, statut VARCHAR(50) DEFAULT \'Brouillon\' NOT NULL, montant_ht NUMERIC(12, 2) DEFAULT NULL, tva NUMERIC(5, 2) DEFAULT NULL, montant_ttc NUMERIC(12, 2) DEFAULT NULL, date_emission DATE DEFAULT NULL, date_echeance DATE DEFAULT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, date_fin TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_facture_affaire ON facture (affaire_id)');
        $this->addSql('CREATE INDEX idx_facture_client ON facture (client_id)');
        $this->addSql('CREATE INDEX idx_facture_statut ON facture (statut)');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT fk_achat_affaire FOREIGN KEY (affaire_id) REFERENCES affaire (id) ON UPDATE CASCADE ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT fk_achat_site FOREIGN KEY (site_id) REFERENCES site (id) ON UPDATE CASCADE ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reglement ADD CONSTRAINT fk_reglement_facture FOREIGN KEY (facture_id) REFERENCES facture (id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT fk_facture_affaire FOREIGN KEY (affaire_id) REFERENCES affaire (id) ON UPDATE CASCADE ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT fk_facture_client FOREIGN KEY (client_id) REFERENCES client (id) ON UPDATE CASCADE ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uq_fonction_code ON fonction (code)');
        $this->addSql('ALTER TABLE agent_equipe ADD CONSTRAINT fk_agent_equipe_agent FOREIGN KEY (agent_matricule) REFERENCES agent (matricule) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE agent_equipe ADD CONSTRAINT fk_agent_equipe_equipe FOREIGN KEY (equipe_id) REFERENCES equipe (id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_agent_equipe_agent ON agent_equipe (agent_matricule)');
        $this->addSql('CREATE INDEX idx_agent_equipe_equipe ON agent_equipe (equipe_id)');
        $this->addSql('CREATE UNIQUE INDEX uq_agent_equipe ON agent_equipe (equipe_id, agent_matricule)');
        $this->addSql('ALTER TABLE agent_fonction ADD CONSTRAINT fk_agent_fonction_agent FOREIGN KEY (agent_matricule) REFERENCES agent (matricule) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE agent_fonction ADD CONSTRAINT fk_agent_fonction_fonction FOREIGN KEY (fonction_id) REFERENCES fonction (id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_agent_fonction_fonction ON agent_fonction (fonction_id)');
        $this->addSql('CREATE UNIQUE INDEX uq_agent_fonction ON agent_fonction (agent_matricule, fonction_id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT fk_client_adresse FOREIGN KEY (adresse_id) REFERENCES adresse (id) ON UPDATE CASCADE ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE site_affaire ADD CONSTRAINT fk_site_affaire_affaire FOREIGN KEY (affaire_id) REFERENCES affaire (id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE site_affaire ADD CONSTRAINT fk_site_affaire_site FOREIGN KEY (site_id) REFERENCES site (id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uq_site_affaire ON site_affaire (site_id, affaire_id)');
        $this->addSql('ALTER TABLE agence ADD CONSTRAINT fk_agence_adresse FOREIGN KEY (adresse_id) REFERENCES adresse (id) ON UPDATE CASCADE ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE documents_repertoire ADD CONSTRAINT fk_docs_auteur FOREIGN KEY (auteur_matricule) REFERENCES agent (matricule) ON UPDATE CASCADE ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_docs_checksum ON documents_repertoire (checksum_sha256)');
        $this->addSql('CREATE INDEX idx_docs_cible ON documents_repertoire (cible_type, cible_id)');
        $this->addSql('CREATE INDEX idx_docs_nom ON documents_repertoire (nom_fichier)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT fk_equipe_agence FOREIGN KEY (agence_id) REFERENCES agence (id) ON UPDATE CASCADE ON DELETE RESTRICT NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_equipe_agence ON equipe (agence_id)');
        $this->addSql('ALTER TABLE rapport_maintenance ADD CONSTRAINT fk_rapport_maintenance_adresse FOREIGN KEY (adresse_client_id) REFERENCES adresse (id) ON UPDATE CASCADE ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rapport_maintenance ADD CONSTRAINT fk_rapport_maintenance_agent FOREIGN KEY (matricule) REFERENCES agent (matricule) ON UPDATE CASCADE ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rapport_maintenance ADD CONSTRAINT fk_rapport_maintenance_maintenance FOREIGN KEY (maintenance_id) REFERENCES maintenance (id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_rapport_maintenance ON rapport_maintenance (maintenance_id)');
        $this->addSql('CREATE INDEX idx_rapport_maintenance_date ON rapport_maintenance (date_rapport)');
        $this->addSql('CREATE INDEX idx_rapport_maintenance_etat ON rapport_maintenance (etat)');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT fk_rendezvous_intervention FOREIGN KEY (intervention_id) REFERENCES intervention (id) ON UPDATE CASCADE ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT fk_rendezvous_site FOREIGN KEY (site_id) REFERENCES site (id) ON UPDATE CASCADE ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE images ADD cible_type VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE images ADD cible_id BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT fk_images_auteur FOREIGN KEY (auteur_matricule) REFERENCES agent (matricule) ON UPDATE CASCADE ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_images_auteur ON images (auteur_matricule)');
        $this->addSql('CREATE INDEX idx_images_target ON images (cible_type, cible_id)');
        $this->addSql('ALTER TABLE site ADD CONSTRAINT fk_site_adresse FOREIGN KEY (adresse_id) REFERENCES adresse (id) ON UPDATE CASCADE ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE passeport ADD CONSTRAINT fk_passeport_agent FOREIGN KEY (agent_matricule) REFERENCES agent (matricule) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uq_passeport_agent ON passeport (agent_matricule)');
        $this->addSql('ALTER TABLE agent ADD CONSTRAINT fk_agent_agence FOREIGN KEY (agence_id) REFERENCES agence (id) ON UPDATE CASCADE ON DELETE RESTRICT NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE agent ADD CONSTRAINT fk_agent_user FOREIGN KEY (user_id) REFERENCES users (id) ON UPDATE CASCADE ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT fk_intervention_maintenance FOREIGN KEY (maintenance_id) REFERENCES maintenance (id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT fk_intervention_prec FOREIGN KEY (intervention_precedente_id) REFERENCES intervention (id) ON UPDATE CASCADE ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE doe ADD CONSTRAINT fk_doe_affaire FOREIGN KEY (affaire_id) REFERENCES affaire (id) ON UPDATE CASCADE ON DELETE RESTRICT NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE doe ADD CONSTRAINT fk_doe_site FOREIGN KEY (site_id) REFERENCES site (id) ON UPDATE CASCADE ON DELETE RESTRICT NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_doe_affaire ON doe (affaire_id)');
        $this->addSql('CREATE INDEX idx_doe_site ON doe (site_id)');
        $this->addSql('ALTER TABLE agence_membre ADD CONSTRAINT fk_agence_membre_agence FOREIGN KEY (agence_id) REFERENCES agence (id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE agence_membre ADD CONSTRAINT fk_agence_membre_agent FOREIGN KEY (agent_matricule) REFERENCES agent (matricule) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_agence_membre_agence ON agence_membre (agence_id)');
        $this->addSql('CREATE INDEX idx_agence_membre_agent ON agence_membre (agent_matricule)');
        $this->addSql('CREATE UNIQUE INDEX uq_agence_membre ON agence_membre (agence_id, agent_matricule)');
        $this->addSql('CREATE INDEX idx_affaire_client ON affaire (client_id)');
        $this->addSql('ALTER TABLE maintenance ADD CONSTRAINT fk_maintenance_affaire FOREIGN KEY (affaire_id) REFERENCES affaire (id) ON UPDATE CASCADE ON DELETE RESTRICT NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE maintenance ADD CONSTRAINT fk_maintenance_doe FOREIGN KEY (doe_id) REFERENCES doe (id) ON UPDATE CASCADE ON DELETE RESTRICT NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_maintenance_affaire ON maintenance (affaire_id)');
        $this->addSql('CREATE INDEX idx_maintenance_doe ON maintenance (doe_id)');
        $this->addSql('CREATE INDEX idx_maintenance_etat ON maintenance (etat)');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT fk_formation_agent FOREIGN KEY (agent_matricule) REFERENCES agent (matricule) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_formation_agent ON formation (agent_matricule)');
        $this->addSql('CREATE INDEX idx_formation_expiration ON formation (date_expiration)');
    }
}
