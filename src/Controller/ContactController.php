<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ContactController
 * @package App\Controller
 * @Route("/", name="app_")
 */
class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('contact/contact.html.twig', [
            'titre_page' => $titrePage = "Contact",
            'titre_section' => $titreSection = "page de contact",

        ]);
    }
}
