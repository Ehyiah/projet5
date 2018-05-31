<?php

namespace App\UI\Action;


use App\Domain\Builder\Interfaces\UserBuilderInterface;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Twig\Environment;

/**
 * Class RegistrationAction
 * @package App\UI\Action
 */
class RegistrationAction
{
    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    /**
     * @var UserBuilderInterface
     */
    private $userBuilder;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * RegistrationAction constructor.
     *
     * @param EncoderFactoryInterface $encoderFactory
     * @param UserBuilderInterface $userBuilder
     * @param FormFactoryInterface $formFactory
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(EncoderFactoryInterface $encoderFactory, UserBuilderInterface $userBuilder, FormFactoryInterface $formFactory, Environment $twig, UrlGeneratorInterface $urlGenerator)
    {
        $this->encoderFactory = $encoderFactory;
        $this->userBuilder = $userBuilder;
        $this->formFactory = $formFactory;
        $this->twig = $twig;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request)
    {
        $form = $this->formFactory->create(UserType::class)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $encoder = $this->encoderFactory->getEncoder(User::class);

            $this->userBuilder->createFromRegistration(
                'Toto',
                'tot@gmail.com',
                'azerty',
                \Closure::fromCallable([$encoder, 'encodePassword'])
            );
            return new RedirectResponse($this->urlGenerator->generate('home'));
        }
        return new Response($this->twig->render(':Image:CreateNewImage.html.twig'));

    }
}