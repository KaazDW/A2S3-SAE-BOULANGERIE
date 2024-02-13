<?php

namespace App\Controller;

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

use TCPDF;
use App\Form\FactureType;



class FactureController extends AbstractController
{
    #[Route('/facture', name: 'app_facture')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FactureFilterType::class);
        $form->handleRequest($request);

        $dateReservation = $form->get('dateReservation')->getData();

        // Convertir la date au format 'Y-m-d' si elle n'est pas vide
        if ($dateReservation) {
            $dateReservation = DateTime::createFromFormat('d/m/Y', $dateReservation)->format('Y-m-d');
        }

        $date = DateTime::createFromFormat('d/m/Y', '01/01/2024')->format('Y-m-d');

        $selectedDate = [
            'type' => 'dateReservation',
            'value' => $date,
        ];

        // Récupérer toutes les factures avec les détails de l'utilisateur et les produits
        $factures = $entityManager->getRepository(Facture::class)->findAllFromDate($selectedDate);

        return $this->render('facture/index.html.twig', [
            'factures' => $factures,
            'form' => $form->createView(),
        ]);
    }

    // RECUPERE LES FACTURES QUI SONT COMMANDEES A LA DATE DONNEE EN PARAMETRE
    #[Route('/factures/{date}', name: 'getFacturesParDate')]
    public function getFacturesParDate(string $date, EntityManagerInterface $entityManager): Response {
        //Modifie le format de la date
        $dateObj = DateTime::createFromFormat('Y-m-d', $date);

        //Cas ou la conversion échoue
        if ($dateObj === false) {
            return new Response('Format de date invalide.', Response::HTTP_BAD_REQUEST);
        }
        // Mets la date au bon format
        $formattedDate = $dateObj->format('Y-m-d');

        // TABLEAU QUI SERVIRA AU REPOSITORY
        $selectedDate = [
            'type' => 'dateReservation',
            'value' => $formattedDate,
        ];

        // RECUPERE LES FACTURES A LA DATE $SELECTEDDATE
        $factures = $entityManager->getRepository(Facture::class)->findAllWithUserDetailsAndProducts($selectedDate);
    
        return $this->render('facture/factureParDate.html.twig', [
            'factures' => $factures,
        ]);
    }

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

                // si le paiement est déjà effectué, recupere sa valeur, sinon ce sera la date et l'heure actuelle
                if($request->request->get('typePaiement')=="dejaEffectue"){
                    $datePaiement = $request->request->get('datePaiement');
                    $datePaiementObj = DateTime::createFromFormat('Y-m-d\TH:i', $datePaiement);

                    $facture->setDatePaiement($datePaiementObj);
                }
                else{
                    $facture->setDatePaiement(new DateTime());
                }
            
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

            }
        
            return $this->render('facture/commande.html.twig', [
                'produits' => $produits,
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

}