<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240121125303 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facture ADD prenom VARCHAR(255) NOT NULL, ADD nom VARCHAR(255) NOT NULL, CHANGE date_creation date_creation DATETIME NOT NULL');
//
//        //Insertion Facture Test, tout sur l'user 1
//        $this->addSql("INSERT INTO facture (user_id, montant, date_reservation, date_paiement, date_creation, prenom, nom) VALUES (1, 30, '2024-03-08', '2024-03-05 18:40:51', NOW(), 'pauline', 'Trontin');");
//        $this->addSql("INSERT INTO facture (user_id, montant, date_reservation, date_paiement, date_creation, prenom, nom) VALUES (1, 47, '2024-03-08', '2024-03-05 18:40:51', NOW(), 'pauline', 'Trontin');");
//        $this->addSql("INSERT INTO facture (user_id, montant, date_reservation, date_paiement, date_creation, prenom, nom) VALUES (1, 32, '2024-03-13', '2024-03-05 18:40:51', NOW(), 'pauline', 'Trontin');");
//        $this->addSql("INSERT INTO facture (user_id, montant, date_reservation, date_paiement, date_creation, prenom, nom) VALUES (1, 6, '2024-03-08', '2024-03-05 18:40:51', NOW(), 'pauline', 'Trontin');");
//        $this->addSql("INSERT INTO facture (user_id, montant, date_reservation, date_paiement, date_creation, prenom, nom) VALUES (1, 16, '2024-03-15', '2024-03-05 18:40:51', NOW(), 'pauline', 'Trontin');");
//
//
//        //Insertion FactureProduit Test
//
//        //Facture 1
//        $this->addSql("INSERT INTO facture_produit (id_produit, id_facture, quantite) VALUES (6, 1, 1););");
//        $this->addSql("INSERT INTO facture_produit (id_produit, id_facture, quantite) VALUES (2, 1, 2););");
//        $this->addSql("INSERT INTO facture_produit (id_produit, id_facture, quantite) VALUES (5, 1, 1););");
//
//        //Facture 2
//        $this->addSql("INSERT INTO facture_produit (id_produit, id_facture, quantite) VALUES (7, 2, 3););");
//        $this->addSql("INSERT INTO facture_produit (id_produit, id_facture, quantite) VALUES (8, 2, 2););");
//        $this->addSql("INSERT INTO facture_produit (id_produit, id_facture, quantite) VALUES (10, 2, 1););");
//        $this->addSql("INSERT INTO facture_produit (id_produit, id_facture, quantite) VALUES (4, 2, 2););");
//
//        //Facture 3
//        $this->addSql("INSERT INTO facture_produit (id_produit, id_facture, quantite) VALUES (1, 3, 1););");
//        $this->addSql("INSERT INTO facture_produit (id_produit, id_facture, quantite) VALUES (8, 3, 2););");
//        $this->addSql("INSERT INTO facture_produit (id_produit, id_facture, quantite) VALUES (10, 3, 1););");
//        $this->addSql("INSERT INTO facture_produit (id_produit, id_facture, quantite) VALUES (5, 3, 1););");
//
//        //Facture 4
//        $this->addSql("INSERT INTO facture_produit (id_produit, id_facture, quantite) VALUES (6, 4, 1););");
//
//        //Facture 5
//        $this->addSql("INSERT INTO facture_produit (id_produit, id_facture, quantite) VALUES (2, 5, 1););");
//        $this->addSql("INSERT INTO facture_produit (id_produit, id_facture, quantite) VALUES (3, 5, 1););");

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facture DROP prenom, DROP nom, CHANGE date_creation date_creation DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
    }
}
