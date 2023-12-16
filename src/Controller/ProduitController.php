<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProduitRepository;
use App\Repository\RecetteRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Recette;

class ProduitController extends AbstractController
{
    #[Route('/produit', name: 'produits')]
    public function index(ProduitRepository $produitRepository): Response
    {
        //Recupere l'ensemble des produits
        $produits = $produitRepository->findAll();

        return $this->render('produit/index.html.twig', [
            'produits' => $produits,
        ]);
    }

    // PEUT ETRE MODIFIER IDRECETTE ET IDINGREDIENT POUR NE PRENDRE QUE L'ID DE LA RECETTE
    #[Route('/produit/modifQuantiteIngr/{idRecette}/{quantite}', name: 'modifierQuantite', methods: ['GET', 'POST'])]
    public function majQuantiteIngredient(RecetteRepository $recetteRepository, EntityManagerInterface $entityManager, Request $request, $idRecette, $quantite): Response
    {
        //SI METHODE GET RENVOIE LE FORMULAIRE POUR MODIFIER LA QUANTITE DE L'INGREDIENT
        if ($request->isMethod('GET')){
            return $this->render('produit/modifQuantiteIngr/modifForm.html.twig', [
                'idRecette' => $idRecette,
                'quantite' => $quantite,
            ]);
        }

        // SI METHODE POST MODIFIE LA QUANTITE DE L'INGREDIENT ET METS A JOUR LA PAGE AVEC LA NOUVELLE QUANTITE
        elseif ($request->isMethod('POST')) {
            //recupere la nouvelle quantite
            $nouvelleQuantite = $request->request->get('quantite');

            // RECUPERE LA RECETTE ET METS A JOUR LA QUANTITE DE SON INGREDIENT
            $recette = $entityManager->getRepository(Recette::class)->find($idRecette);
            $recette->setQuantite($nouvelleQuantite);
            $entityManager->flush();

            return $this->render('produit/modifQuantiteIngr/quantiteModifiee.html.twig', [
                'idRecette' => $idRecette,
                'quantite' => $nouvelleQuantite,
            ]);
        }
    }

    #[Route('/produit/test2', name: 'test2', methods: ['GET', 'PUT'])]
    public function test2(ProduitRepository $produitRepository, Request $request): Response
    {
        // Recupere l'ensemble des produits
        $produits = $produitRepository->findAll();
    
        if ($request->isMethod('PUT')) {
            // Logique de traitement pour la requête PUT
            // Cela pourrait inclure la mise à jour de la base de données, etc.
        }
    
        return $this->render('produit/modifQuantiteIngr/test2.html.twig');
    }
}
