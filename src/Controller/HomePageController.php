<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class HomePageController extends AbstractController
{

    /**
     * @Route("/homepage", name="homepage")
     */
    public function HomePage(): Response
    {
        $selected = 1; //  1 or 0 je ne sais pas pourquoi ni a quoi cela correspond mais si on le mets pas : erreur
        return $this->render('Client/homepage.html.twig', ['selected' => $selected]);
    }

    /**
     * @Route("/contact", name="contactpage")
     */
    public function ContactPage(): Response
    {
        return $this->render('Client/contact.html.twig');
    }

    /**
     * @Route("/evenement", name="evenementpage")
     */
    public function EvenementPage(): Response
    {
        return $this->render('Client/evenement.html.twig');
    }

    /**
     * @Route("/ecomusee", name="ecomuseepage")
     */
    public function EcoMuseePage(): Response
    {
        return $this->render('Client/ecomusee.html.twig');
    }

    /**
     * @Route("/produit", name="produitpage")
     */
    public function ProduitPage(): Response
    {
        return $this->render('Client/produit.html.twig');
    }

    /**
         * @Route("/panier", name="panierpage")
     */
    public function PanierPage(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('Client/panier.html.twig');
    }

    /**
     * @Route("/profil/info", name="informationprofilpage")
     */
    public function informations(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('Client/profil.html.twig');
    }

    /**
     * @Route("/profil/historique", name="historiqueprofilpage")
     */
    public function historique(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('Client/historiqueCommand.html.twig');
    }




}