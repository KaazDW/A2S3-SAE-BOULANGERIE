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
use App\Entity\Produit;
use App\Entity\Ingredient;
use App\Form\ProduitFormType;

class ProduitController extends AbstractController
{
    #[Route('/produit', name: 'produits')]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        //  FORMULAIRE D'AJOUT DE PRODUIT POUR L'INTERIEUR DE LA MODAL

        // Crée une nouvelle instance de l'entité Produit
        $produit = new Produit();

        // Crée le formulaire en utilisant ProduitFormType et l'entité Produit
        $form = $this->createForm(ProduitFormType::class, $produit);

        // Traite la demande
        $form->handleRequest($request);

        // Vérifie si le formulaire a été soumis et est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Sauvegarde le produit en base de données
            $entityManager->persist($produit);
            $entityManager->flush();

            // Redirige l'utilisateur vers une autre page, par exemple, la liste des produits
            return $this->redirectToRoute('produits');
        }

        //Recupere l'ensemble des produits
        $produits = $entityManager->getRepository(Produit::class)->findAll();
        return $this->render('produit/index.html.twig', [
            'produits' => $produits,
            'form' => $form->createView(),

        ]);
    }

    // PEUT ETRE MODIFIER IDRECETTE ET IDINGREDIENT POUR NE PRENDRE QUE L'ID DE LA RECETTE
    #[Route('/produit/modifQuantiteIngr/{idRecette}/{quantite}', name: 'modifierQuantite', methods: ['GET', 'POST'])]
    public function majQuantiteIngredient(EntityManagerInterface $entityManager, Request $request, $idRecette, $quantite): Response
    {
        //SI METHODE GET RENVOIE LE FORMULAIRE POUR MODIFIER LA QUANTITE DE L'INGREDIENT
        if ($request->isMethod('GET')){
            $recette = $entityManager->getRepository(Recette::class)->find($idRecette);

            return $this->render('produit/modifQuantiteIngr/modifForm.html.twig', [
                'recette' => $recette,
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
                'recette' => $recette,
                'quantite' => $nouvelleQuantite,
            ]);
        }
    }

    // PEUT ETRE MODIFIER IDRECETTE ET IDINGREDIENT POUR NE PRENDRE QUE L'ID DE LA RECETTE
    #[Route('/produit/modifProduit/{idProduit}', name: 'modifProduit', methods: ['GET', 'POST'])]
    public function majProduit(EntityManagerInterface $entityManager, Request $request, $idProduit): Response
    {
        $produit = $entityManager->getRepository(Produit::class)->find($idProduit);
        return $this->render('produit/modifProduit/modifProduitForm.html.twig', [
            'produit' => $produit,
        ]);
    }

    #[Route('/produit/majPrixProduit/{idProduit}', name: 'majPrixProduit')]
    public function majPrixProduit(EntityManagerInterface $entityManager, Request $request, $idProduit): Response
    {

        //SI METHODE GET RENVOIE LE FORMULAIRE POUR MODIFIER LA QUANTITE DU PRODUIT
        if ($request->isMethod('GET')){
            // RECUPERE LE PRODUIT ET SON PRIX ACTUEL
            $produit = $entityManager->getRepository(Produit::class)->find($idProduit);
            return $this->render('produit/modifProduit/majPrixProduit.html.twig', [
                'produit' => $produit,
            ]);
        }

        // SI METHODE POST MODIFIE LE PRIX UNITAIRE DU PRODUIT ET METS A JOUR LA DIV
        elseif ($request->isMethod('POST')) {
            //recupere le nouveaux prix
            $nouveauPrix = $request->request->get('prix');

            // RECUPERE LE PRODUIT ET METS A JOUR SON PRIX
            $produit = $entityManager->getRepository(Produit::class)->find($idProduit);
            $produit->setPrixUnitaire($nouveauPrix);
            $entityManager->flush();

            return $this->render('produit/modifProduit/prixModifie.html.twig', [
                'produit' => $produit,
            ]);
        }


        $produit = $entityManager->getRepository(Produit::class)->find($idProduit);
        return $this->render('produit/modifProduit/majPrixProduit.html.twig', [
            'produit' => $produit,
        ]);




    }

    #[Route('/produit/ajouterIngredient/{idProduit}', name: 'ajouterIngredient', methods: ['GET', 'POST'])]
    public function ajouterIngredient(EntityManagerInterface $entityManager, Request $request, $idProduit): Response
    {
        // SI METHODE GET RENVOIE LE FORMULAIRE POUR AJOUTER L'INGREDIENT
        if ($request->isMethod('GET')){

            //recupere le produit avec l'id donné en param
            $produit = $entityManager->getRepository(Produit::class)->find($idProduit);
            //recupere l'ensemble des ingredients
            $ingredients = $entityManager->getRepository(Ingredient::class)->findAll();

            return $this->render('produit/ajouterIngredient/ajouterIngredientForm.html.twig', [
                'produit' => $produit,
                'ingredients' => $ingredients,
            ]);
        }

        // SI METHODE POST CREER L'INGREDIENT
        elseif ($request->isMethod('POST')) {

            $quantite = $request->request->get('quantite'); //recupere la quantite
            $ingredientChoisi = $request->request->get('ingredient'); // recupere l'id de l'ingredient
            $ingredient = $entityManager->getRepository(Ingredient::class)->find($ingredientChoisi); // recupere l'ingredient grâce à son id
            $produit = $entityManager->getRepository(Produit::class)->find($idProduit); // recupere le produit avec son id

            // Creer le lien entre le produit et l'ingredient (et sa quantite) en ajoutant une recette
            $recette = new Recette();
            $recette->setIngredient($ingredient);
            $recette->setProduit($produit);
            $recette->setQuantite($quantite);

            // mets a jour la bdd
            $entityManager->persist($recette);
            $entityManager->flush();

            return $this->render('produit/ajouterIngredient/ingredientAjoute.html.twig', [
                'produit' => $produit,
                'ingredient' => $ingredient,
                'recette' => $recette
            ]);
        }
        
    }


    #[Route('/produit/supprimerIngredient/{idRecette}', name: 'supprimerIngredient')]
    public function supprimerIngredient(EntityManagerInterface $entityManager, $idRecette)
    {
        //recupere la recette en bdd
        $recette = $entityManager->getRepository(Recette::class)->find($idRecette);
        

        if (!$recette) {
            // Gére le cas où la recette n'est pas trouvée
            return new Response('Recette non trouvée.', Response::HTTP_NOT_FOUND);
        }

        // Supprime la recette de la base de données
        $entityManager->remove($recette);
        $entityManager->flush();

        return new Response();
    }

    #[Route('/produit/supprimerProduit/{idProduit}', name: 'supprimerProduit')]
    public function supprimerProduit(EntityManagerInterface $entityManager, $idProduit, RecetteRepository $recetteRepository)
    {
        // Récupère le produit en BDD
        $produit = $entityManager->getRepository(Produit::class)->find($idProduit);

        if (!$produit) {
            // Gérer le cas où le produit n'est pas trouvé
            return new Response('Produit non trouvée.', Response::HTTP_NOT_FOUND);
        }

        // Récupère les recettes associées au produit via le RecetteRepository
        $recettes = $recetteRepository->findBy(['produit' => $produit]);

        // Supprime chaque recette associée
        foreach ($recettes as $recette) {
            $entityManager->remove($recette);
        }
        // Supprime le produit de la base de données
        $entityManager->remove($produit);
        $entityManager->flush();

        return new Response();
    }
}
