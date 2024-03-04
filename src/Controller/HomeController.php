<?php

namespace App\Controller;

use App\Controller\IngredientController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(EntityManagerInterface $entityManager, IngredientController $test): Response
    {
        $alertCount = $test->stockAlert($entityManager);

        return $this->render('pages/home.html.twig', [
            'alertCount' => $alertCount,
        ]);
    }
}