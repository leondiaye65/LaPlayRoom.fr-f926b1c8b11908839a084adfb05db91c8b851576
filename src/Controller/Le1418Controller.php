<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class Le1418Controller
 * @package App\Controller
 * @Route("/", name="app_")
 */
class Le1418Controller extends AbstractController
{
    /**
     * @Route("/le14_18", name="le14_18")
     */
    public function index(): Response
    {
        return $this->render('le1418/index.html.twig', [
            'titre_page' => $titrePage = "Le 1418",
            'titre_section' => $titreSection = "page Le14_18",

        ]);
    }
}
