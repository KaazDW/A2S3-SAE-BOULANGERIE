<?php

namespace App\Controller;

use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Facture;


class FactureController extends AbstractController
{

    #[Route('/facture', name: 'app_facture')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Récupérer toutes les factures avec les détails de l'utilisateur et les produits
        $factures = $entityManager->getRepository(Facture::class)->findAllWithUserDetailsAndProducts();

        return $this->render('facture/index.html.twig', [
            'factures' => $factures,
        ]);
    }
}
