<?php

namespace App\Controller\Admin;
use App\Entity\User;
use App\Entity\Ingredient;
use App\Entity\Evenement;
use App\Entity\Produit;
use App\Entity\Recette;
use App\Entity\Facture;
use App\Entity\Panier;


use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;


class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(IngredientCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Administration moulin du pont du vent');
    }

    public function configureMenuItems(): iterable
    {
        return [
            // lien vers la page d'accueil
            MenuItem::linkToUrl('Accueil', 'fas fa-home', '/'),

            MenuItem::section('Administration'),
            MenuItem::linkToCrud('Utilisateurs', 'fas fa-user-group', User::class),
            MenuItem::linkToCrud('Ingredients', 'fas fa-bread-slice', Ingredient::class),
            MenuItem::linkToCrud('Produits', 'fas fa-jar', Produit::class),
            MenuItem::linkToCrud('Recettes', 'fas fa-clipboard-list', Recette::class),
            MenuItem::linkToCrud('Factures', 'fas fa-file-lines', Facture::class),
            MenuItem::linkToCrud('Événements', 'fas fa-calendar-days', Evenement::class),
            MenuItem::linkToCrud('Panier', 'fas fa-bag-shopping', Panier::class),
    ];
    }
}
