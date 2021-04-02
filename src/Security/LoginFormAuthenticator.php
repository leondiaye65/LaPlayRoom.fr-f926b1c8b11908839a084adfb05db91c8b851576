<?php

namespace App\Security;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{
    use TargetPathTrait;
    public const LOGIN_ROUTE = 'app_login';

    private $userRepository;
    private $csrfTokenManager;
    private $router;
    private $passwordEncoder;
    private $urlGenerator;


    public function __construct
    (UserRepository $userRepository,
     CsrfTokenManagerInterface $csrfTokenManager,
     RouterInterface $router,
     UserPasswordEncoderInterface $passwordEncoder,
     UrlGeneratorInterface $urlGenerator
    )
    {
        $this->userRepository = $userRepository;
        $this->csrfTokenManager = $csrfTokenManager;
        $this->router = $router;
        $this->passwordEncoder = $passwordEncoder;
        $this->urlGenerator = $urlGenerator;
    }

    public function supports(Request $request)

    {
        return self::LOGIN_ROUTE === $request->attributes->get('_route') && $request->isMethod('POST');
        //Si la méthode posséde une route qui s'appelle 'app_login et que la méthode est de type 'post' la méthode
        // getCredentials peut se déclencer
    }

//La mèthode getCredentials va récupérer les données saisies et les mettre en session c'est à dire l'identifiant du user
//En cas d'erreur d'authentification on peut donc le passer au formulaire et l'afficher à l'utlisateur.)
    public function getCredentials(Request $request)
    {
        $credentials = [
            'email' => $request->request->get('email'),
            'password' => $request->request->get('password'),
            'csrf_token' => $request->request->get('_csrf_token'),
        ];
        $request->getSession()->set(
            Security::LAST_USERNAME,
            $credentials['email']
        );
        return $credentials;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $token = new CsrfToken('authenticate', $credentials['csrf_token']);
        if (!$this->csrfTokenManager->isTokenValid($token)) {
            throw new InvalidCsrfTokenException();
            //si le CsrfToken n'est pas valide il faut lever une exception; sinon:
        }
        return $this->userRepository->findOneBy(['email' => $credentials['email']]);
    }
//la méthode checkCredentials se déclenche uniquement si le return findOneBy n'est pas nul
    public function checkCredentials($credentials, UserInterface $user)
        //Cela return boolean: true || false
    {
        return $this-> passwordEncoder->isPasswordValid($user, $credentials['password']);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey)
    {
        if($targetPath = $this->getTargetPath($request->getSession(), $providerKey)) {
            return new RedirectResponse($targetPath);
        }
        return new RedirectResponse($this->router->generate('la_play_room_accueil'));
    }

    protected function getLoginUrl()
    {
            return $this->router->generate(self::LOGIN_ROUTE);
    }
}
