<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MusicNewsController
 * @package App\Controller
 * @Route("/", name="app_")
 */
class MusicNewsController extends AbstractController
{
    /**
     * @Route("/music-news", name="music_news")
     */
    public function index(): Response
    {
        return $this->render('music_news/index.html.twig', [
            'titre_page' => $titrePage = "Music news",
            'titre_section' => $titreSection = " Page music news",

        ]);
    }
}
