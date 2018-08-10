<?php

namespace App\Security\Interfaces;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

interface AuthenticatorInterface
{
    public function __construct(
        UserPasswordEncoderInterface $userPasswordEncoder,
        UrlGeneratorInterface $urlGenerator
    );

    public function supports(Request $request);

    public function getCredentials(Request $request);

    public function getUser(
        $credentials,
        UserProviderInterface $userProvider
    );

    public function checkCredentials($credentials, UserInterface $user);

    public function onAuthenticationSuccess(
        Request $request,
        TokenInterface $token,
        $providerKey
    );

    public function onAuthenticationFailure(
        Request $request,
        AuthenticationException $exception
    );

    public function start(
        Request $request,
        AuthenticationException $authException = null
    );

    public function supportsRememberMe();
}