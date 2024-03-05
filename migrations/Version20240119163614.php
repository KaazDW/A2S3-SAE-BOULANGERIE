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
        $this->addSql("INSERT INTO produit (`nom`,`prix_unitaire`) VALUES ( 'Amandes Raisin','7.00');");
        $this->addSql("INSERT INTO produit ( `nom`,`prix_unitaire`) VALUES ('Chanvre Amande','8.50');");
        $this->addSql("INSERT INTO produit ( `nom`,`prix_unitaire`) VALUES ('Noix','7.50');");
        $this->addSql("INSERT INTO produit ( `nom`,`prix_unitaire`) VALUES ('Lin Tournesol','7.00');");
        $this->addSql("INSERT INTO produit ( `nom`,`prix_unitaire`) VALUES ( 'Sésame','7.00');");
        $this->addSql("INSERT INTO produit ( `nom`,`prix_unitaire`) VALUES ( '5 Céréales','6.00');");
        $this->addSql("INSERT INTO produit ( `nom`,`prix_unitaire`) VALUES ( 'Blanc','5.00');");
        $this->addSql("INSERT INTO produit ( `nom`,`prix_unitaire`) VALUES ( 'Demi complet','6.00');");
        $this->addSql("INSERT INTO produit ( `nom`,`prix_unitaire`) VALUES ( 'Complet','6.00');");
        $this->addSql("INSERT INTO produit ( `nom`,`prix_unitaire`) VALUES ( 'Intégral','6.00');");
        $this->addSql("INSERT INTO produit ( `nom`,`prix_unitaire`) VALUES ( 'Campagne','6.00');");
        $this->addSql("INSERT INTO produit ( `nom`,`prix_unitaire`) VALUES ( 'Farine de gaudes','3.20');");
        $this->addSql("INSERT INTO produit ( `nom`,`prix_unitaire`) VALUES ( 'Farine de blé T65','2.30');");
        $this->addSql("INSERT INTO produit ( `nom`,`prix_unitaire`) VALUES ( 'Farine de blé T80','2.30');");

        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`,`min_stock`) VALUES ( 'Farines T80','15000','500');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`,`min_stock`) VALUES ( 'Farines T65','20000','400');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`,`min_stock`) VALUES ( 'Farines T110','10000','50');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`,`min_stock`) VALUES ( 'Farines Seigle','30000','5');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`,`min_stock`) VALUES ( 'Farines Epautre','30000','5');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`,`min_stock`) VALUES ( 'Farines Petit Epautre','30000','5');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`,`min_stock`) VALUES ( 'Farines T150','30000','5');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`,`min_stock`) VALUES ( 'Farines Khorasan','30000','5');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`,`min_stock`) VALUES ( 'Farines 5 Céréales','30000','5');");

        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`,`min_stock`) VALUES ( 'Levain Normal','30000','5');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`,`min_stock`) VALUES ( 'Levain Sarrasin','30000','5');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`,`min_stock`) VALUES ( 'Levain Petit épautre','30000','5');");

        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`,`min_stock`) VALUES ( 'Graines Chataîgne','30000','5');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`,`min_stock`) VALUES ( 'Graines Quinoa','30000','5');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`,`min_stock`) VALUES ( 'Graines Tournesol','30000','5');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`,`min_stock`) VALUES ( 'Graines Lin','30000','5');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`,`min_stock`) VALUES ( 'Graines Courge','30000','5');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`,`min_stock`) VALUES ( 'Graines Noix','30000','5');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`,`min_stock`) VALUES ( 'Graines Sesame','30000','5');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`,`min_stock`) VALUES ( 'Graines Raisin','30000','5');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`,`min_stock`) VALUES ( 'Graines Mais','30000','5');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`,`min_stock`) VALUES ( 'Graines Amande','30000','5');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`,`min_stock`) VALUES ( 'Graines Riz','30000','5');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`,`min_stock`) VALUES ( 'Graines Sarrasin','30000','5');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`,`min_stock`) VALUES ( 'Graines Sésame','30000','5');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`,`min_stock`) VALUES ( 'Graines Chanvre','30000','5');");

        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`,`min_stock`) VALUES ( 'Olives','10','5');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`,`min_stock`) VALUES ( 'Sel','10','5');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`,`min_stock`) VALUES ( 'Sucre','10','5');");
        $this->addSql("INSERT INTO ingredient ( `nom`,`stock`,`min_stock`) VALUES ( 'Matière grasse','10','5');");
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
