<?php

namespace App\Controller;

use App\Form\UserRegistrationFormType;
use App\Security\LoginFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;



/**
 * Class SecurityController
 * @package App\Controller
 * @Route("/", name="app_")
 */
class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();


        return $this->render('security/login.html.twig', [
            'titre_page' => $titrePage = "Login",
            'titre_section' => $titreSection = "page de login",
            'error' =>$error,
            'last_username' => $lastUsername

        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */

    public function logout()
    {
        return new \Exception("Sera intercepté avant d'arriver ici");
    }

    /**
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @param GuardAuthenticatorHandler $handler
     * @param LoginFormAuthenticator $authenticator
     * @return Response
     * @Route("/register", name="register")
     */
    public function register(
        Request $request,
        UserPasswordEncoderInterface $encoder,
        GuardAuthenticatorHandler $handler,
        LoginFormAuthenticator $authenticator)
    {

        $form = $this->createForm(UserRegistrationFormType::class);
        $form->handleRequest($request);

        //pour désactiver la validation du formulaire côté client on fait un dd pour récupérer les données saisies
        //dd($form->getData()); //ensuite on va dans <form name= "user_registration_form" method="post" et pour finir
        //on ajoute novalidate>

        if ($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();
            //dd($user);
            $user->setPassword($encoder->encodePassword(
                $user,
                $form['plainPassword']->getData()
            ));
            //dd($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();


            return $handler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main'
            );
        }

        return $this->render('register/register.html.twig',[
            'titre_page' => $titrePage = "Register",
            'titre_section' => $titreSection = "page register",
            'registrationForm' => $form->createView(),

     ]);

    }
}

