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
    /**
     * AuthenticatorInterface constructor.
     *
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        UserPasswordEncoderInterface $userPasswordEncoder,
        UrlGeneratorInterface $urlGenerator
    );

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function supports(Request $request);

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function getCredentials(Request $request);

    /**
     * @param $credentials
     * @param UserProviderInterface $userProvider
     *
     * @return mixed
     */
    public function getUser(
        $credentials,
        UserProviderInterface $userProvider
    );

    /**
     * @param $credentials
     * @param UserInterface $user
     *
     * @return mixed
     */
    public function checkCredentials($credentials, UserInterface $user);

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @param $providerKey
     *
     * @return mixed
     */
    public function onAuthenticationSuccess(
        Request $request,
        TokenInterface $token,
        $providerKey
    );

    /**
     * @param Request $request
     * @param AuthenticationException $exception
     *
     * @return mixed
     */
    public function onAuthenticationFailure(
        Request $request,
        AuthenticationException $exception
    );

    /**
     * @param Request $request
     * @param AuthenticationException|null $authException
     *
     * @return mixed
     */
    public function start(
        Request $request,
        AuthenticationException $authException = null
    );

    /**
     * @return bool|void
     */
    public function supportsRememberMe();
}
