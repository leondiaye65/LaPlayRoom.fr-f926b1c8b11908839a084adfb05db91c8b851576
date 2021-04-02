<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class LaPlayRoomController
 * @package App\Controller
 * @Route("/", name="la_play_room_")
 */
class LaPlayRoomController extends AbstractController

{
    /**
     * @Route("/", name="accueil")
     */
    public function accueil(): Response
    {
        return $this->render('la_play_room/index.html.twig', [
            'msg_accueil' => 'Accueil du site',
        ]);
    }

}
