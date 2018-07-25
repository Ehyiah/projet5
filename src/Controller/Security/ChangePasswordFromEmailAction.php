<?php

namespace App\Controller\Security;


use App\Domain\DTO\Security\ChangePasswordFromEmailDTO;
use App\Infra\Doctrine\Repository\UserRepository;
use App\UI\Form\Handler\Security\ChangePasswordFromEmailHandler;
use App\UI\Form\Type\User\ChangePasswordFromEmailType;
use App\UI\Responder\Security\ChangePasswordFromEmailResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class ChangePasswordFromEmailAction
 * @package App\Controller\Security
 * @Route("/recovery/{token}", name="recoveryToken")
 */
class ChangePasswordFromEmailAction
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var TokenStorageInterface
     */
    private $security;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * ChangePasswordFromEmailAction constructor.
     *
     * @param UserRepository $userRepository
     * @param TokenStorageInterface $security
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(
        UserRepository $userRepository,
        TokenStorageInterface $security,
        FormFactoryInterface $formFactory
    ) {
        $this->userRepository = $userRepository;
        $this->security = $security;
        $this->formFactory = $formFactory;
    }


    /**
     * @param Request $request
     * @param ChangePasswordFromEmailResponder $responder
     * @param ChangePasswordFromEmailHandler $handler
     * @param $token
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        Request $request,
        ChangePasswordFromEmailResponder $responder,
        ChangePasswordFromEmailHandler $handler,
        $token
    ) {
        $dto = new ChangePasswordFromEmailDTO(null, $token);

        $form = $this->formFactory->create(ChangePasswordFromEmailType::class, $dto)
                                    ->handleRequest($request);


        if ($handler->handle($form, $request)) {
            return $responder(true);
        }

        return $responder(false, $form);

    }
}