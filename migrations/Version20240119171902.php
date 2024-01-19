<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240119171902 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Insertion table recette (données réelles du boulanger)';
    }

    public function up(Schema $schema): void
    {
        //Recette pain : Amandes Raisin
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '1','1','820');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '10','1','115');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '18','1','49');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '20','1','225');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '22','1','49');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '31','1','721');");

        //Recette pain : Chanvre Amande
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '1','2','3370');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '10','2','472');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '22','2','573');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '26','2','607');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '31','2','2898');");

        //Recette pain : Noix
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '1','3','10200');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '10','3','1428');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '18','3','2040');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '31','3','8772');");

        //Recette pain : Lin Tournesol
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '1','4','9600');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '10','4','1344');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '15','4','672');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '16','4','864');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '31','4','8640');");

        //Recette pain : Sésame
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '1','5','9167');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '10','5','1283');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '27','5','1467');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '31','5','7883');");

        //Recette pain : 5 Céréales
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '1','6','2502');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '9','6','5005');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '10','6','901');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '16','6','525');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '26','6','751');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '31','6','6156');");

        //Recette pain : Blanc
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '2','7','7492');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '10','7','899');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '31','7','5469');");

        //Recette pain : Demi complet
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '1','8','6531');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '10','8','914');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '31','8','5094');");

        //Recette pain : Complet
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '3','9','3194');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '10','9','319');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '31','9','2427');");

        //Recette pain : Intégral
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '7','10','14000');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '10','10','1680');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '31','10','12040');");

        //Recette pain : Campagne
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '1','11','3591');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '4','11','1539');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '10','11','616');");
        $this->addSql("INSERT INTO recette (`ingredient_id`,`produit_id`,`quantite`) VALUES ( '31','11','4155');");

    }

    public function down(Schema $schema): void
    {
        //Recette pain : Amandes Raisin
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '1'and `produit_id` = '1';");
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '10'and `produit_id` = '1';");
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '18'and `produit_id` = '1';");
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '20'and `produit_id` = '1';");
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '22'and `produit_id` = '1';");
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '31'and `produit_id` = '1';");

        //Recette pain : Chanvre Amande
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '1'and `produit_id` = '2';");
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '10'and `produit_id` = '2';");
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '22'and `produit_id` = '2';");
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '26'and `produit_id` = '2';");
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '31'and `produit_id` = '2';");

        //Recette pain : Noix
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '1'and `produit_id` = '3';");
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '10'and `produit_id` = '3';");
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '18'and `produit_id` = '3';");
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '31'and `produit_id` = '3';");

        //Recette pain : Lin Tournesol
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '1'and `produit_id` = '4';");
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '10'and `produit_id` = '4';");
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '15'and `produit_id` = '4';");
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '16'and `produit_id` = '4';");
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '31'and `produit_id` = '4';");

        //Recette pain : Sésame
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '1'and `produit_id` = '5';");
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '10'and `produit_id` = '5';");
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '27'and `produit_id` = '5';");
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '31'and `produit_id` = '5';");

        //Recette pain : 5 Céréales
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '1'and `produit_id` = '6';");
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '9'and `produit_id` = '6';");
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '10'and `produit_id` = '6';");
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '16'and `produit_id` = '6';");
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '26'and `produit_id` = '6';");
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '31'and `produit_id` = '6';");

        //Recette pain : Blanc
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '2'and `produit_id` = '7';");
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '10'and `produit_id` = '7';");
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '31'and `produit_id` = '7';");

        //Recette pain : Demi complet
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '1'and `produit_id` = '8';");
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '10'and `produit_id` = '8';");
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '31'and `produit_id` = '8';");

        //Recette pain : Complet
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '3'and `produit_id` = '9';");
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '10'and `produit_id` = '9';");
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '31'and `produit_id` = '9';");


        //Recette pain : Intégral
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '7'and `produit_id` = '10';");
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '10'and `produit_id` = '10';");
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '31'and `produit_id` = '10';");

        //Recette pain : Campagne
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '1'and `produit_id` = '11';");
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '4'and `produit_id` = '11';");
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '10'and `produit_id` = '11';");
        $this->addSql("DELETE FROM recette WHERE `ingredient_id` = '31'and `produit_id` = '11';");

    }
}

