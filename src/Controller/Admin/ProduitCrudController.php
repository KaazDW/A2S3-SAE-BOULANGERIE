<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProduitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produit::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new ('nom');

        yield NumberField::new('prix_unitaire')
        ->setLabel('Prix unitaire')
        ->setHelp('Saisissez le prix unitaire avec deux chiffres après la virgule.')
        ->setFormTypeOptions([
            'scale' => 2, // Définissez le nombre de chiffres après la virgule
        ]);        
        
        yield AssociationField::new('ingredients');

    }
}
