<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class LeLiveRoomController
 * @package App\Controller
 * @Route("/", name="app_")
 */
class LeLiveRoomController extends AbstractController
{
    /**
     * @Route("/le-live-room", name="le_live_room")
     */
    public function index(): Response
    {
        return $this->render('le_live_room/index.html.twig', [
            'titre_page' => $titrePage = "Le_live_room",
            'titre_section' => $titreSection = "page le_live_room",

        ]);
    }
}
