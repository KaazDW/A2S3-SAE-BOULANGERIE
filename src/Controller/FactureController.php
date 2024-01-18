<?php

namespace App\Controller;

use App\Entity\Produit;
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
use TCPDF;



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

//        $selectedDate = [
//            'type' => 'dateReservation',
//            'value' => $dateReservation,
//        ];

        $date = DateTime::createFromFormat('d/m/Y', '01/01/2024')->format('Y-m-d');

        $selectedDate = [
            'type' => 'dateReservation',
            'value' => $date,
        ];

        // Récupérer toutes les factures avec les détails de l'utilisateur et les produits
        $factures = $entityManager->getRepository(Facture::class)->findAllWithUserDetailsAndProducts($selectedDate);

        return $this->render('facture/index.html.twig', [
            'factures' => $factures,
            'form' => $form->createView(),
        ]);
    }
    #[Route('/factures/{date}', name: 'getFacturesParDate')]
    public function getFacturesParDate(string $date, EntityManagerInterface $entityManager): Response {
        // Modifiez le format pour correspondre à "année-jour-mois"
        $dateObj = DateTime::createFromFormat('Y-m-d', $date);
    
        if ($dateObj === false) {
            // Gérez le cas où la conversion échoue
            return new Response('Format de date invalide.', Response::HTTP_BAD_REQUEST);
        }
    
        $formattedDate = $dateObj->format('Y-m-d');

        $selectedDate = [
            'type' => 'dateReservation',
            'value' => $formattedDate,
        ];

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

    #[Route('/création_commande', name: 'commande')]
    public function passerCommande( EntityManagerInterface $entityManager): Response
    {
        return $this->render('facture/commande.html.twig', [

        ]);
    }

}
