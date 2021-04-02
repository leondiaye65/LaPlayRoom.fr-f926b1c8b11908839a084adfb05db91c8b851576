<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class NewsEventsController
 * @package App\Controller
 * @Route("/", name="app_")
 */
class NewsEventsController extends AbstractController
{
    /**
     * @Route("/news-events", name="news_events")
     */
    public function index(): Response
    {
        return $this->render('news_events/index.html.twig', [
            'titre_page' => $titrePage = "News_Events",
            'titre_section' => $titreSection = "page news_events",

        ]);
    }
}
