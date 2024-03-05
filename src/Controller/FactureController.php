<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Form\FactureFilterType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Facture;
use App\Entity\Produit;
use App\Entity\FactureProduit;
use App\Form\FactureDateSelectionType;


use TCPDF;
use App\Form\FactureType;



class FactureController extends AbstractController
{
    #[Route('/facture', name: 'app_facture')]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {


        $affichage = false;
        // Appel à la fonction pour récupérer le formulaire de sélection de date
        $form = $this->createForm(FactureDateSelectionType::class);
        $form->handleRequest($request);

        // Initialisation de la date sélectionnée
        $selectedDate = null;

        // Récupération de la date sélectionnée s'il existe
        if ($form->isSubmitted() && $form->isValid()) {
            $selectedDate = $form->get('selected_date')->getData();

            // Récupérer les factures en fonction de la date sélectionnée
            $factures = $entityManager->getRepository(Facture::class)->findBy(['dateReservation' => $selectedDate]);
//            dd($factures);
//            $affichage = true;

        }

        // Récupération des factures en fonction de la date sélectionnée
        $factures = [];
        if ($selectedDate !== null) {
            $factures = $entityManager->getRepository(Facture::class)->findBy(['dateReservation' => $selectedDate]);
        } else {
            $factures = $entityManager->getRepository(Facture::class)->findAll();
        }

        // Filtrer les factures avec l'état égal à 1
        $factures = array_filter($factures, function($facture) {
            return $facture->getEtat() == 0;
        });

        // Récupération des ingrédients
        $ingredients = $entityManager->getRepository(Ingredient::class)->findAll();

        // Initialisation des tableaux pour stocker les données
        $produits = [];
        $produitTotals = [];
        $quantitesTotalesIngredients = [];

        // Calcul des données pour les factures

        return $this->render('facture/index.html.twig', [
            'factures' => $factures,
            'produits' => $produits,
            'produitTotals' => $produitTotals,
            'quantitesTotalesIngredients' => $quantitesTotalesIngredients,
            'ingredients' => $ingredients,
            'form' => $form->createView(),
            'affichage' => $affichage,

        ]);
    }

    public function factureParDate(): Response
    {
        $form = $this->createForm(FactureDateSelectionType::class);

        return $this->render('components/facture-parDate.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/factureSelect', name: 'app_factureSelect')]
    public function factureSelect(EntityManagerInterface $entityManager,Request $request): Response
    {
        // Récupérer les identifiants des factures sélectionnées
        $formData = $request->request->all();
        $factureIds = $formData['factures_selectionnees'];
        $factures = $entityManager->getRepository(Facture::class)->findBy(['id' => $factureIds]);

        $ingredients = $entityManager->getRepository(Ingredient::class)->findAll();

        $affichage = true;

        // Initialisation des tableaux pour stocker les données
        $produits = [];
        $produitTotals = [];
        $quantitesTotalesIngredients = [];

        // Calcul de la quantité totale de chaque ingrédient et des autres données
        foreach ($factures as $facture) {
            foreach ($facture->getProduits() as $produitFacture) {
                    $produit = $produitFacture->getProduit();
                    $produitNom = $produit->getNom();
                    $quantiteProduit = $produitFacture->getQuantite();

                    // Ajout du produit s'il n'existe pas encore dans le tableau
                    if (!isset($produits[$produitNom])) {
                        $produits[$produitNom] = $produit;
                    }

                    // Calcul du total de chaque produit
                    if (!isset($produitTotals[$produitNom])) {
                        $produitTotals[$produitNom] = 0;
                    }
                    $produitTotals[$produitNom] += $quantiteProduit;

                    // Calcul de la quantité totale de chaque ingrédient
                    foreach ($produit->getIngredients() as $ingredientProduit) {
                        $ingredientNom = $ingredientProduit->getIngredient()->getNom();
                        $quantite = $ingredientProduit->getQuantite() * $quantiteProduit;

                        // Ajout de la quantité à celle déjà existante pour cet ingrédient
                        if (!isset($quantitesTotalesIngredients[$ingredientNom])) {
                            $quantitesTotalesIngredients[$ingredientNom] = 0;
                        }
                        $quantitesTotalesIngredients[$ingredientNom] += $quantite;
                    }
            }
        }

        if ($request->isMethod('POST')) {
            $formData = $request->request->all();
            $factureIds = $formData['factures_selectionnees'];

            // Mettre à jour l'état des factures sélectionnées
            $factures = $entityManager->getRepository(Facture::class)->findBy(['id' => $factureIds]);
            foreach ($factures as $facture) {
                $facture->setEtat(true); // Mettre l'état à true
                $entityManager->persist($facture);
            }
            $entityManager->flush();

            // Récupérer le stock avant la mise à jour
            $stocksAvant = [];
            foreach ($ingredients as $ingredient) {
                $stocksAvant[$ingredient->getId()] = $ingredient->getStock();
            }
            // Mettre à jour le stock des ingrédients
            foreach ($factures as $facture) {
                foreach ($facture->getProduits() as $produitFacture) {
                    foreach ($produitFacture->getProduit()->getIngredients() as $ingredientProduit) {
                        $ingredient = $ingredientProduit->getIngredient();
                        $quantiteUtilisee = $ingredientProduit->getQuantite() * $produitFacture->getQuantite();
                        $nouveauStock = $stocksAvant[$ingredient->getId()] - $quantiteUtilisee;

                        // Mettre à jour le stock après utilisation
                        $ingredient->setStock($nouveauStock);

                        // Enregistrement de l'ingrédient mis à jour
                        $entityManager->persist($ingredient);
                    }
                }
            }

// Flush pour appliquer les modifications
            $entityManager->flush();

// Récupérer le stock après la mise à jour
            $stocksApres = [];
            foreach ($ingredients as $ingredient) {
                $stocksApres[$ingredient->getId()] = $ingredient->getStock();
            }



        }


            return $this->render('facture/index.html.twig', [
            'factures' => $factures,
            'produits' => $produits,
            'produitTotals' => $produitTotals,
            'quantitesTotalesIngredients' => $quantitesTotalesIngredients,
            'ingredients' => $ingredients,
                'stocksAvant' => $stocksAvant,
                'stocksApres' => $stocksApres,
                'affichage' => $affichage,
        ]);
    }

    // RECUPERE LES FACTURES QUI SONT COMMANDEES A LA DATE DONNEE EN PARAMETRE
//    #[Route('/factures/{date}', name: 'getFacturesParDate')]
//    public function getFacturesParDate(string $date, EntityManagerInterface $entityManager): Response {
//        //Modifie le format de la date
//        $dateObj = DateTime::createFromFormat('Y-m-d', $date);
//
//        //Cas ou la conversion échoue
//        if ($dateObj === false) {
//            return new Response('Format de date invalide.', Response::HTTP_BAD_REQUEST);
//        }
//        // Mets la date au bon format
//        $formattedDate = $dateObj->format('Y-m-d');
//
//        // TABLEAU QUI SERVIRA AU REPOSITORY
//        $selectedDate = [
//            'type' => 'dateReservation',
//            'value' => $formattedDate,
//        ];
//
//        // RECUPERE LES FACTURES A LA DATE $SELECTEDDATE
//        $factures = $entityManager->getRepository(Facture::class)->findAllWithUserDetailsAndProducts($selectedDate);
//
//        return $this->render('facture/factureParDate.html.twig', [
//            'factures' => $factures,
//        ]);
//    }

    #[Route('/visualiser_facture/{id}', name: 'visualiser_facture')]
    public function visualiserFacture(int $id, EntityManagerInterface $entityManager): Response
    {
        $facture = $this->getFactureById($id, $entityManager);

        $pdfContent = $this->generatePdfContent($facture);

        $response = new Response($pdfContent);
        $response->headers->set('Content-Type', 'application/pdf');

        return $response;
    }


    private function getFactureById(int $id, EntityManagerInterface $entityManager): Facture
    {
        $repositoryFacture = $entityManager->getRepository(Facture::class);
        $facture = $repositoryFacture->findOneBy(['id' => $id]);

        if (!$facture) {
            throw $this->createNotFoundException('Facture non trouvée.');
        }

        return $facture;
    }

    private function generatePdfContent(Facture $facture): string
    {
        $pdf = new TCPDF();
        $pdf->AddPage();
        $pdf->writeHTML($this->renderView('facture/facture.html.twig', ['facture' => $facture]));

        return $pdf->Output('Facture_' . $facture->getId() . '.pdf', 'S');
    }

    private function createPdfResponse(string $pdfContent, Facture $facture): Response
    {
        $response = new Response($pdfContent);
        $response->headers->set('Content-Type', 'application/pdf');
        $response->headers->set('Content-Disposition', 'attachment; filename=Facture_' . $facture->getId() . '.pdf');

        return $response;
    }

    #[Route('/telecharger_facture/{id}', name: 'telecharger_facture')]
    public function telechargerFacture(int $id, EntityManagerInterface $entityManager): Response
    {
        $facture = $this->getFactureById($id, $entityManager);
        $pdfContent = $this->generatePdfContent($facture);
        $response = $this->createPdfResponse($pdfContent, $facture);

        return $response;
    }

    #[Route('/creation_commande', name: 'commande')]
    public function passerCommande( EntityManagerInterface $entityManager, Request $request): Response
    {
        {
            // Recupere les produits par nom croissant
            $produits = $entityManager->getRepository(Produit::class)->findBy([], ['nom' => 'ASC']);

            // TRAITEMENT DE LA SOUMISSION DU FORMULAIRE
            if ($request->isMethod('POST')) {

                $montantFacture = 0.00;

                $facture = new Facture();

                // set l'utilisateur comme celui connecté
                $user = $this->getUser();
                $facture->setUser($user);

                // date creation pour la date et l'heure actuelle
                $dateEtHeureActuelle = new DateTime();
                $facture->setDateCreation($dateEtHeureActuelle);

                // set le nom
                $nom = $request->request->get('nom');
                $facture->setNom($nom);

                // set le prenom
                $prenom = $request->request->get('prenom');
                $facture->setPrenom($prenom);

                // METS LA DATE AU BON FORMAT ET SET LA DATE DE RESERVATION
                $dateReservation = $request->request->get('dateReservation');
                $dateObj = DateTime::createFromFormat('Y-m-d', $dateReservation);
                $facture->setDateReservation($dateObj);

                // set l'etat
                $etat = false;
                $facture->setEtat($etat);

                // si le paiement est déjà effectué, recupere sa valeur, sinon ce sera la date et l'heure actuelle
                if($request->request->get('typePaiement')=="dejaEffectue"){
                    $datePaiement = $request->request->get('datePaiement');
                    $datePaiementObj = DateTime::createFromFormat('Y-m-d\TH:i', $datePaiement);

                    $facture->setDatePaiement($datePaiementObj);
                }
                else{
                    $facture->setDatePaiement(new DateTime());
                }

                // $request->request->all() pour obtenir toutes les données du formulaire
                $formData = $request->request->all();
                // accede aux données du tableau associatif 'quantiteProduit'
                $quantiteProduitArray = $formData['quantiteProduit'] ?? [];

                // POUR CHAQUE ELEMENT PRESENT DANS LE TABLEAU, CREE UNE NOUVELLE INSTANCE DE factureProduit
                foreach($quantiteProduitArray as $idProduit => $quantite){
                    // Recupere le produit
                    $produit = $entityManager->getRepository(Produit::class)->find($idProduit);

                    // Mets à jour la valeur totale
                    $montantFacture += $quantite * $produit->getPrixUnitaire();

                    if ($produit) {
                        // Créé une nouvelle instance de FactureProduit
                        $factureProduit = new FactureProduit();
                        $factureProduit->setProduit($produit);
                        $factureProduit->setFacture($facture);
                        $factureProduit->setQuantite($quantite);

                        $entityManager->persist($factureProduit);
                    }
                    else{
                        return new Response('Le produit n\'est pas trouvé', Response::HTTP_BAD_REQUEST);
                    }

                }
                $facture->setMontant($montantFacture);

                // enregistre les changements en bdd
                $entityManager->persist($facture);

                $entityManager->flush();
                $this->addFlash('success', 'La commande a été passée avec succès.');
            }

            return $this->render('facture/commande.html.twig', [
                'produits' => $produits,
                'admin' => 1,
            ]);
        }

    }

    // FONCTION PERMETTANT DE RECUPERE UNE CERTAINE QUANTITE DE PRODUIT QUI SONT LES PLUS ACHETEES D'UN CERTAIN MOIS 
    #[Route('/meilleursProduits', name: 'meilleursProduitsMensuel')]
    public function recupMeilleursProduitsMensuel(EntityManagerInterface $entityManager, Request $request): Response
    {
        // RECUPERE LA DATE ET LA QUANTITE DE PRODUIT A RECUPERER EN GET

        $moisEtAnnee = $request->query->get('anneeMois');
        list($annee, $mois) = explode('-', $moisEtAnnee);
        $annee = (int)$annee;
        $mois = (int)$mois;

        $qteProduits = $request->query->get('qteProduits');

        // RECUPERE L'ENSEMBLE DES PRODUITS LES PLUS VENDUS DANS LE MOIS DE L'ANNEE AVEC UNE LIMITE EQUIVALENTE A qteProduits
        $meilleursProduits = $entityManager->getRepository(Facture::class)->trouverMeilleursProduitsMensuel($annee, $mois,$qteProduits );
        dd($meilleursProduits);

        return new response();
    }

    /**
     * @throws \Exception
     */
    #[Route('/historique', name: 'facture_histo')]
    public function historiqueFacture(Request $request, EntityManagerInterface $entityManager): Response
    {
        $repositoryFacture = $entityManager->getRepository(Facture::class);
        $selectedDate = $request->query->get('selected_date');

        $factures = $repositoryFacture->findBy(['etat' => 1]);

        if ($selectedDate) {
            $selectedDateTime = new \DateTime($selectedDate);
            $factures = $repositoryFacture->findBy(['dateReservation' => $selectedDateTime, 'etat' => 1]);
        }

        return $this->render('facture/historique.html.twig', [
            'facturesParDate' => $factures,
        ]);
    }


}