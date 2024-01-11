<?php

namespace App\Controller;

use App\Entity\Ingredient;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IngredientController extends AbstractController
{
    #[Route('/ingredient', name: 'app_ingredient')]
    public function index(): Response
    {
        return $this->render('ingredient/index.html.twig', [
            'controller_name' => 'IngredientController',
        ]);
    }

    #[Route('/alert-stock', name: 'alert_stock')]
    public function checkStockAlert(EntityManagerInterface $entityManager): Response
    {
        $ingredients = $entityManager->getRepository(Ingredient::class)->findAll();

        $alertIngredients = [];
        foreach ($ingredients as $ingredient) {
            if ($ingredient->getStock() === $ingredient->getMinStock()) {
                $alertIngredients[] = $ingredient;
            }
        }

        return $this->render('ingredient/alert.html.twig', [
            'alertIngredients' => $alertIngredients,
        ]);
    }
}
