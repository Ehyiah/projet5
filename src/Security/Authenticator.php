<?php

namespace App\Security;


use App\Security\Interfaces\AuthenticatorInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

/**
 * Class Authenticator
 */
class Authenticator extends AbstractGuardAuthenticator
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * Authenticator constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        UserPasswordEncoderInterface $userPasswordEncoder,
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->urlGenerator = $urlGenerator;
    }


    /**
     * {@inheritdoc}
     */
    public function supports(Request $request)
    {
        if (($request->attributes->get("_route") === "login") && ($request->isMethod("POST"))) {
            return true;
        }
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function getCredentials(Request $request)
    {
        return array(
            'username' => $request->request->get('login')['username'],
            'password' => $request->request->get('login')['password']
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        return $userProvider->loadUserByUsername($credentials['username']);
    }

    /**
     * {@inheritdoc}
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
        if ($this->userPasswordEncoder->isPasswordValid($user, $credentials['password'])) {
            return true;
        }
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        $targetPath = $request->getSession()->get('_security.'.$providerKey.'.target_path');
        #$targetPath = $request->headers->get();

        if ($targetPath != null) {
            return new RedirectResponse($targetPath);
        }

        return new RedirectResponse('home');
    }

    /**
     * {@inheritdoc}
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return new RedirectResponse(
            $this->urlGenerator->generate('login')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        // TODO: Implement start() method.
    }

    /**
     * {@inheritdoc}
     */
    public function supportsRememberMe()
    {
        // TODO: Implement supportsRememberMe() method.
    }
}
