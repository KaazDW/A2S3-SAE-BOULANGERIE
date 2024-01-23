<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240119163614 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Insert produit réel du boulanger';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("INSERT INTO produit (`nom`,`prix_unitaire`) VALUES ( 'Amandes Raisin','1.00');");
        $this->addSql("INSERT INTO produit ( `nom`,`prix_unitaire`) VALUES ('Chanvre Amande','1.50');");
        $this->addSql("INSERT INTO produit ( `nom`,`prix_unitaire`) VALUES ('Noix','2.00');");
        $this->addSql("INSERT INTO produit ( `nom`,`prix_unitaire`) VALUES ('Lin Tournesol','1.45');");
        $this->addSql("INSERT INTO produit ( `nom`,`prix_unitaire`) VALUES ( 'Sésame','4.70');");
        $this->addSql("INSERT INTO produit ( `nom`,`prix_unitaire`) VALUES ( '5 Céréales','3.00');");
        $this->addSql("INSERT INTO produit ( `nom`,`prix_unitaire`) VALUES ( 'Blanc','1.00');");
        $this->addSql("INSERT INTO produit ( `nom`,`prix_unitaire`) VALUES ( 'Demi complet','1.50');");
        $this->addSql("INSERT INTO produit ( `nom`,`prix_unitaire`) VALUES ( 'Complet','2.00');");
        $this->addSql("INSERT INTO produit ( `nom`,`prix_unitaire`) VALUES ( 'Intégral','3.00');");
        $this->addSql("INSERT INTO produit ( `nom`,`prix_unitaire`) VALUES ( 'Campagne','4.00');");

        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Farines T80','10');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Farines T65','15');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Farines T110','20');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Farines Seigle','10');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Farines Epautre','10');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Farines Petit Epautre','10');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Farines T150','10');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Farines Khorasan','10');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Farines 5 Céréales','10');");

        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Levain Normal','10');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Levain Sarrasin','10');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Levain Petit épautre','10');");

        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Graines Chataîgne','10');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Graines Quinoa','10');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Graines Tournesol','10');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Graines Lin','10');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Graines Courge','10');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Graines Noix','10');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Graines Sesame','10');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Graines Raisin','10');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Graines Mais','10');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Graines Amande','10');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Graines Riz','10');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Graines Sarrasin','10');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Graines Sésame','10');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Graines Chanvre','10');");

        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Olives','10');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Sel','10');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Sucre','10');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Matière grasse','10');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`) VALUES ( 'Eau','0');");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DELETE FROM produit WHERE `nom` = 'Amandes Raisin';");
        $this->addSql("DELETE FROM produit WHERE `nom` = 'Chanvre Amande';");
        $this->addSql("DELETE FROM produit WHERE `nom` = 'Noix';");
        $this->addSql("DELETE FROM produit WHERE `nom` = 'Lin Tournesol';");
        $this->addSql("DELETE FROM produit WHERE `nom` = 'Sésame';");
        $this->addSql("DELETE FROM produit WHERE `nom` = '5 Céréales';");
        $this->addSql("DELETE FROM produit WHERE `nom` = 'Blanc';");
        $this->addSql("DELETE FROM produit WHERE `nom` = 'Demi complet';");
        $this->addSql("DELETE FROM produit WHERE `nom` = 'Complet';");
        $this->addSql("DELETE FROM produit WHERE `nom` = 'Intégral';");
        $this->addSql("DELETE FROM produit WHERE `nom` = 'Campagne';");

        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Farines T80';");
        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Farines T65';");
        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Farines T110';");
        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Farines Seigle';");
        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Farines Epautre';");
        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Farines Petit Epautre';");
        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Farines T150';");
        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Farines Khorasan';");
        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Farines 5 Céréales';");

        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Levain Normal';");
        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Levain Sarrasin';");
        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Levain Petit épautre';");

        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Graines Chataîgne';");
        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Graines Quinoa';");
        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Graines Tournesol';");
        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Graines Lin';");
        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Graines Courge';");
        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Graines Noix';");
        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Graines Sesame';");
        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Graines Raisin';");
        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Graines Mais';");
        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Graines Amande';");
        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Graines Riz';");
        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Graines Sarrasin';");
        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Graines Sésame';");
        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Graines Chanvre';");

        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Olives';");
        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Matière grasse';");
        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Eau';");
        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Sucre';");
        $this->addSql("DELETE FROM ingredient WHERE `nom` = 'Sel';");
    }
}
