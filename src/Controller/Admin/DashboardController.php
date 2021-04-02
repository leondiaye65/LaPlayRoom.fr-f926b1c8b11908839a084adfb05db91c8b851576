<?php

namespace App\Controller\Admin;

use App\Entity\Commentaire;
use App\Entity\Rubrique;
use App\Entity\Theme;
use App\Entity\User;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DashboardController
 * @package App\Controller\Admin
 * @IsGranted("ROLE_ADMIN")
 * @Route("/admin", name="bo_")
 */
class DashboardController extends AbstractDashboardController
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /**
     * @Route("/", name="accueil")
     */
    public function index(): Response
    {
        //dd(count($this->userRepository->findAll()));
        return $this->render('bundles/EasyAdminBundle/welcome.html.twig',[
            "titre_page" =>$titrePage="Back_Office",
            "nb_users" => $nbUsers = count($this->userRepository->findAll()),
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('LAPLAYROOM.Fr');


    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('DASHBOARD', 'fa fa-home');

        yield MenuItem::section('Gérer les Users');
        yield MenuItem::linkToCrud('Users', 'fa fa-fas fa-list', User::class);

        yield MenuItem::section('Gérer des Rubriques');
        yield MenuItem::linkToCrud('Rubriques', 'fas fa-list',Rubrique::class);

        yield MenuItem::section('Gérer les Themes');
        yield MenuItem::linkToCrud('Themes', 'fas fa-list',Theme::class);

        yield MenuItem::section('Gérer les Commentaires');
        yield MenuItem::linkToCrud('Commentaires', 'fas fa-list',Commentaire::class);




    }
}
