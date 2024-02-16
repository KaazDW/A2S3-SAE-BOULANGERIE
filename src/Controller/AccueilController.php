<?php

namespace App\Controller;

use App\Entity\Facture;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'accueil')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Facture::class);

        $chiffreAffaireAnneeEnCours = $repository->findChiffreAffaireAnneeEnCours();
        $chiffreAffaireAnneePrecedente = $repository->findChiffreAffaireAnneePrecedente();
        $chiffreAffaireMois = $repository->findChiffreAffaireMois();
        $Top3ProduitsVendusCeMois = $repository->findTop3ProduitsVendusCeMois();

        // RECUPERE L'ANNEE ET LE MOIS ACTUEL
        $annee = (int) date('Y');
        $mois = (int) date('m');
    
        $qteProduits = 3;
        // PAR DEFAUT RECUPERE LES 3 PRODUITS LES PLUS VENDUS DURANT LE MOIS DE L'ANNEE ACTUELLE 
        $meilleursProduits = $entityManager->getRepository(Facture::class)->trouverMeilleursProduitsMensuel($annee, $mois,$qteProduits );

        return $this->render('pages/accueil.html.twig',[
            'chiffreAffaireAnneeEnCours' => $chiffreAffaireAnneeEnCours,
            'chiffreAffaireAnneePrecedente' => $chiffreAffaireAnneePrecedente,
            'chiffreAffaireMois' => $chiffreAffaireMois,
            'Top3ProduitsVendusCeMois' => $Top3ProduitsVendusCeMois,
            'MeilleursProduits' => $meilleursProduits,
        ]);
    }

    #[Route('/accueil/dashBoardMeilleursProduits', name: 'dashBoardMeilleursProduits')]
    public function recupMeilleursProduitsMensuel(EntityManagerInterface $entityManager, Request $request): Response
    {
        // RECUPERE LA DATE ET LA QUANTITE DE PRODUIT A RECUPERER EN GET
        $moisEtAnnee = $request->query->get('anneeMois');
        list($annee, $mois) = explode('-', $moisEtAnnee);
        $annee = (int) $annee;
        $mois = (int) $mois;

        $qteProduits = $request->query->get('qteProduits');

        // RECUPERE L'ENSEMBLE DES PRODUITS LES PLUS VENDUS DANS LE MOIS DE L'ANNEE AVEC UNE LIMITE EQUIVALENTE A qteProduits
        $meilleursProduits = $entityManager->getRepository(Facture::class)->trouverMeilleursProduitsMensuel($annee, $mois, $qteProduits);
        
        return $this->render('pages/accueil/majDashboardMeilleurProduits.html.twig',[
            'meilleursProduits' => $meilleursProduits,
        ]);
    }
}