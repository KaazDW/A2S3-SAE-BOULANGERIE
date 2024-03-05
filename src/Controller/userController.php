<?php

namespace App\Controller;

use App\Entity\Facture;
use App\Entity\Ingredient;
use App\Entity\Produit;
use DateTime;
use App\Entity\FactureProduit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class userController extends AbstractController
{
    #[Route('/user/commande', name: 'commande_user')]
    public function passerCommande(EntityManagerInterface $entityManager, Request $request): Response
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