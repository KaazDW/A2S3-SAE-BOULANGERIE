<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231029195317 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredient CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE stock_kg stock_kg DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE produit ADD qte_en_stock INT DEFAULT NULL, DROP ingredient, CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE prix prix DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE produit_ingredient RENAME INDEX id_ingredient TO IDX_C297417DCE25F8A7');
        $this->addSql('DROP INDEX UNIQ_8D93D64919EB6921 ON user');
        $this->addSql('ALTER TABLE user DROP client_id');
        $this->addSql('ALTER TABLE utilisateur CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE prenom prenom VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL, CHANGE adresse adresse VARCHAR(255) DEFAULT NULL, CHANGE telephone telephone VARCHAR(255) DEFAULT NULL, CHANGE type type VARCHAR(255) DEFAULT \'user\' NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredient CHANGE stock_kg stock_kg NUMERIC(15, 2) DEFAULT NULL, CHANGE nom nom VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE produit ADD ingredient VARCHAR(50) DEFAULT NULL, DROP qte_en_stock, CHANGE nom nom VARCHAR(50) DEFAULT NULL, CHANGE prix prix NUMERIC(15, 2) DEFAULT NULL');
        $this->addSql('ALTER TABLE produit_ingredient RENAME INDEX idx_c297417dce25f8a7 TO id_ingredient');
        $this->addSql('ALTER TABLE user ADD client_id INT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64919EB6921 ON user (client_id)');
        $this->addSql('ALTER TABLE utilisateur CHANGE nom nom VARCHAR(50) NOT NULL, CHANGE prenom prenom VARCHAR(50) NOT NULL, CHANGE email email VARCHAR(100) NOT NULL, CHANGE telephone telephone VARCHAR(20) DEFAULT NULL, CHANGE type type VARCHAR(50) DEFAULT \'user\' NOT NULL, CHANGE adresse adresse VARCHAR(300) DEFAULT NULL');
    }
}
