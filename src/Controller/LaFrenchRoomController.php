<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class LaFrenchRoomController
 * @package App\Controller
 * @Route("/", name="app_")
 */
class LaFrenchRoomController extends AbstractController
{
    /**
     * @Route("/la-french-room", name="la_french_room")
     */
    public function index(): Response
    {
        return $this->render('la_french_room/index.html.twig', [
            'titre_page' => $titrePage = "La_french_room",
            'titre_section' => $titreSection = "page la_french_room",

        ]);
    }
}
