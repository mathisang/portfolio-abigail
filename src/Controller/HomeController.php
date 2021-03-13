<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        return $this->render('homepage/index.html.twig', [
            'active_page' => 'homepage',
        ]);
    }

    /**
     * @Route("/realisations", name="realisations")
     */
    public function realisations(): Response
    {
        return $this->render('realisations/index.html.twig', [
            'active_page' => 'realisations',
        ]);
    }
}
