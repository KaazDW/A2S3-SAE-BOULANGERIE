<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ErrorController extends AbstractController
{

    public function __construct()
    {
//        $this->errorCode = $errorCode;
    }

    /**
     * @Route("/error/{errorCode}", name="error", requirements={"errorCode"="\d+"})
     */
    public function showError(): Response
    {
        return $this->render('error/' . 'error.html.twig');
    }
}
