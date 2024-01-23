<?php

namespace App\Controller;

use App\Entity\Facture;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'accueil')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $date = new \DateTime();

        $repository = $entityManager->getRepository(Facture::class);

        $chiffreAffaireAnneeEnCours = $repository->findChiffreAffaireAnneeEnCours();
        $chiffreAffaireAnneePrecedente = $repository->findChiffreAffaireAnneePrecedente();
        $chiffreAffaireMois = $repository->findChiffreAffaireMois();
        $Top3ProduitsVendusCeMois = $repository->findTop3ProduitsVendusCeMois();

        return $this->render('pages/accueil.html.twig',[
            'chiffreAffaireAnneeEnCours' => $chiffreAffaireAnneeEnCours,
            'chiffreAffaireAnneePrecedente' => $chiffreAffaireAnneePrecedente,
            'chiffreAffaireMois' => $chiffreAffaireMois,
            'Top3ProduitsVendusCeMois' => $Top3ProduitsVendusCeMois,
        ]);
    }
}