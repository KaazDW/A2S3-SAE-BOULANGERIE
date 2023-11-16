<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231029192040 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {

        $this->addSql('DROP TABLE produit_ingredient');
        $this->addSql('DROP TABLE Produit');
        $this->addSql('DROP TABLE Ingredient');
        $this->addSql('DROP TABLE Utilisateur');

        $this->addSql('CREATE TABLE Utilisateur (
            id_utilisateur INT AUTO_INCREMENT,
            nom VARCHAR(50) NOT NULL,
            prenom VARCHAR(50) NOT NULL,
            email VARCHAR(100) NOT NULL,
            adresse VARCHAR(300),
            telephone VARCHAR(20),
            type VARCHAR(50) NOT NULL DEFAULT \'user\',
            mdp VARCHAR(255) NOT NULL,
            PRIMARY KEY(id_utilisateur)
        )');

        $this->addSql('CREATE TABLE Produit (
            id_produit INT AUTO_INCREMENT,
            nom VARCHAR(50),
            prix DECIMAL(15, 2),
            ingredient VARCHAR(50),
            PRIMARY KEY(id_produit)
        )');

        $this->addSql('CREATE TABLE Ingredient (
            id_ingredient INT AUTO_INCREMENT,
            nom VARCHAR(50) NOT NULL,
            stock_kg DECIMAL(15, 2),
            PRIMARY KEY(id_ingredient)
        )');

        $this->addSql('CREATE TABLE produit_ingredient (
            id_produit INT,
            id_ingredient INT,
            PRIMARY KEY(id_produit, id_ingredient),
            FOREIGN KEY(id_produit) REFERENCES Produit(id_produit),
            FOREIGN KEY(id_ingredient) REFERENCES Ingredient(id_ingredient)
        )');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE produit_ingredient');
        $this->addSql('DROP TABLE Produit');
        $this->addSql('DROP TABLE Ingredient');
        $this->addSql('DROP TABLE Utilisateur');
    }
}
