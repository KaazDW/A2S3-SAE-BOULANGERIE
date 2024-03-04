<?php

namespace App\Controller;

use App\Entity\Facture;
use App\Entity\Ingredient;
use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class userController extends AbstractController
{
    #[Route('/user/commande', name: 'commande_user')]
    public function passerCommande(EntityManagerInterface $entityManager): Response
    {
        // Récupérez l'utilisateur connecté
        $user = $this->getUser();

        // Vérifiez si l'utilisateur est connecté
        if (!$user) {
            // Redirigez l'utilisateur vers la page de connexion s'il n'est pas connecté
            return $this->redirectToRoute('app_login');
        }

        // Recupere les produits par nom croissant
        $produits = $entityManager->getRepository(Produit::class)->findBy([], ['nom' => 'ASC']);



        // Passez la variable user au template
        return $this->render('facture/commande.html.twig', [
            'user' => $user,
            'produits' => $produits,
            'admin' => 0,
        ]);
    }

    #[Route('/user/profil', name: 'profil')]
    public function profil(): Response
    {
        $user = $this->getUser();

        return $this->render('user/profil.html.twig', [
            'user' => $user,
        ]);
    }

    public function factureUser(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $userId = $user->getId();

        // Récupérer les factures liées à cet utilisateur depuis la base de données
        $factures = $entityManager->getRepository(Facture::class)->findBy(['user' => $userId]);

        return $this->render('components/facture-user.html.twig', [
            'user' => $user,
            'factures' => $factures,
        ]);
    }
}