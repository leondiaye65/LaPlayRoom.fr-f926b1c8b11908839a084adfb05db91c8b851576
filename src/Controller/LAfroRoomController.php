<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class LAfroRoomController
 * @package App\Controller
 * @Route("/", name="app_")
 */
class LAfroRoomController extends AbstractController
{
    /**
     * @Route("/l-afro-room", name="l_afro_room")
     */
    public function index(): Response
    {
        return $this->render('l_afro_room/index.html.twig', [
            'titre_page' => $titrePage = "L_Afro_Room",
            'titre_section' => $titreSection = "page l-afro-room",

        ]);
    }
}
