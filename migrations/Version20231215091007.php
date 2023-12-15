<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231215091007 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Insertion table Produit et Ingredient';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("INSERT INTO produit (`nom`,`prix_unitaire`) VALUES ( 'Baguette','1.00');");
        $this->addSql("INSERT INTO produit ( `nom`,`prix_unitaire`) VALUES ('Baguette au nois','1.50');");
        $this->addSql("INSERT INTO produit ( `nom`,`prix_unitaire`) VALUES ('Baguette au seigle','1.99');");
        $this->addSql("INSERT INTO produit ( `nom`,`prix_unitaire`) VALUES ('Pain au chocolat','1.45');");
        $this->addSql("INSERT INTO produit ( `nom`,`prix_unitaire`) VALUES ( 'Brioche','4.70');");

        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Farine de blé','10');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Farine Blanche','15');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Eau','30');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Sucre','5');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Sel','3');");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DELETE FROM produit WHERE `nom` = 'Baguette';");
        $this->addSql("DELETE FROM produit WHERE `nom` = 'Baguette au nois';");
        $this->addSql("DELETE FROM produit WHERE `nom` = 'Baguette au seigle';");
        $this->addSql("DELETE FROM produit WHERE `nom` = 'Pain au chocolat';");
        $this->addSql("DELETE FROM produit WHERE `nom` = 'Brioche';");

        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Farine de blé';");
        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Farine Blanche';");
        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Eau';");
        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Sucre';");
        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Sel';");
    }
}
