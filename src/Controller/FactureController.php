<?php

namespace App\Controller;

use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
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
    public function index(EntityManagerInterface $entityManager): Response
    {
        // R�cup�rer toutes les factures avec les d�tails de l'utilisateur et les produits
        $factures = $entityManager->getRepository(Facture::class)->findAllWithUserDetailsAndProducts();

        return $this->render('facture/index.html.twig', [
            'factures' => $factures,
        ]);
    }

   /* #[Route('/telecharger_facture/{id}', name: 'telecharger_facture')]
    public function telechargementFacture(Facture $facture): BinaryFileResponse
    {
        // Logique pour générer le fichier de facture ici
        $content = 'Contenu de la facture...';

        // Générer un fichier temporaire pour la démo
        $tempFile = tempnam(sys_get_temp_dir(), 'facture_');
        file_put_contents($tempFile, $content);

        // Retourner le fichier en tant que réponse
        $response = new BinaryFileResponse($tempFile);
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'facture_'.$facture->getId().'.pdf'
        );

        return $response;
    }  */

    /*
    #[Route('/visualiser_facture/{id}', name: 'visualiser_facture')]
    public function visualiserFacture(int $id, EntityManagerInterface $entityManager): Response
    {
        $repositoryFacture = $entityManager->getRepository(Facture::class);
        $Facture = $repositoryFacture->findOneBy(['id' => $id]);

        $pdf = new TCPDF();
        $pdf->AddPage();
        $pdf->writeHTML($this->renderView('facture/Facture.html.twig', ['facture' => $Facture]));

        $response = new Response($pdf->Output('Facture_'.$Facture->getId().'.pdf', 'S'));
        $response->headers->set('Content-Type', 'application/pdf');

        return $response;
    }

    #[Route('/telecharger_facture/{id}', name: 'telecharger_facture')]
    public function telechargementFacture(int $id, EntityManagerInterface $entityManager)
    {
        /*$repositoryFacture = $entityManager->getRepository(Facture::class);
        $Facture = $repositoryFacture->findOneBy(['id' => $id]);

        // Générez le fichier PDF avec TCPDF
        $pdf = new TCPDF();
        $pdf->AddPage();
        $pdf->writeHTML($this->renderView('facture/Facture.html.twig', ['Facture' => $Facture]));

        // Sauvegardez le fichier PDF sur le serveur
        $pdfPath = $this->getParameter('kernel.project_dir') . '/public/pdf/';
        $pdfFileName = 'Facture_'.$Facture->getId().'.pdf';
        $pdfFilePath = $pdfPath . $pdfFileName;
        $pdf->Output($pdfFilePath, 'F');

        // Renvoyez le fichier PDF en tant que réponse de téléchargement
        $response = new BinaryFileResponse($pdfFilePath);
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $pdfFileName);
        $response->headers->set('Content-Type', 'application/pdf');

        return $response;
    }*/

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
    $pdf->writeHTML($this->renderView('facture/Facture.html.twig', ['facture' => $facture]));

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


}
