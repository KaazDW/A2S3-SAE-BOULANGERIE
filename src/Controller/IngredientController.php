<?php

namespace App\Controller;

use App\Entity\Account;
use App\Entity\Ingredient;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IngredientController extends AbstractController
{
    #[Route('/ingredient', name: 'app_ingredient')]
    public function index(): Response
    {
        return $this->render('ingredient/indexPopo.html.twig', [
            'controller_name' => 'IngredientController',
        ]);
    }

    public function stockAlert(EntityManagerInterface $entityManager): Response
    {
        $ingredients = $entityManager->getRepository(Ingredient::class)->findAll();

        $alertIngredients = [];
        foreach ($ingredients as $ingredient) {
            $stock = $ingredient->getStock();
            $minStock = $ingredient->getMinStock();

            if ($stock === $minStock || $stock < $minStock) {
                $alertIngredients[] = $ingredient;
            }
        }
        return $this->render('components/stock.html.twig', [
            'alertIngredients' => $alertIngredients,
        ]);
    }
}
