<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class userController extends AbstractController
{
    #[Route('/commande_user', name: 'commande_user')]
    public function passerCommande(): Response
    {
        // Récupérez l'utilisateur connecté
        $user = $this->getUser();

        // Vérifiez si l'utilisateur est connecté
        if (!$user) {
            // Redirigez l'utilisateur vers la page de connexion s'il n'est pas connecté
            return $this->redirectToRoute('app_login');
        }

        // Passez la variable user au template
        return $this->render('user/commande.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/profil', name: 'profils')]
    public function profil(): Response
    {
        return $this->render('user/profil.html.twig');
    }
}