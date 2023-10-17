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
    public function HomePage()
    {
        $selected = 1; //  1 or 0 je ne sais pas pourquoi ni a quoi cela correspond mais si on le mets pas : erreur
        return $this->render('Client/homepage.html.twig', ['selected' => $selected]);
    }

    /**
     * @Route("/contact", name="contactpage")
     */
    public function ContactPage()
    {
        return $this->render('Client/contact.html.twig');
    }

    /**
     * @Route("/evenement", name="evenementpage")
     */
    public function EvenementPage()
    {
        return $this->render('Client/evenement.html.twig');
    }

    /**
     * @Route("/ecomusee", name="ecomuseepage")
     */
    public function EcoMuseePage()
    {
        return $this->render('Client/ecomusee.html.twig');
    }

    /**
     * @Route("/produit", name="produitpage")
     */
    public function ProduitPage()
    {
        return $this->render('Client/produit.html.twig');
    }

    /**
     * @Route("/panier", name="panierpage")
     */
    public function PanierPage()
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('Client/panier.html.twig');
    }


}