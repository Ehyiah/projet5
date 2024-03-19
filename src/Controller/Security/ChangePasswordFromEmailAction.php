<?php

namespace App\Controller\Security;

use App\Controller\Security\Interfaces\ChangePasswordFromEmailActionInterface;
use App\Domain\DTO\Security\ChangePasswordFromEmailDTO;
use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use App\Repository\UserRepository;
use App\UI\Form\Handler\Security\Interfaces\ChangePasswordFromEmailHandlerInterface;
use App\UI\Form\Type\User\ChangePasswordFromEmailType;
use App\UI\Responder\Security\Interfaces\ChangePasswordFromEmailResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class ChangePasswordFromEmailAction
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
     * @var ChangePasswordFromEmailHandlerInterface
     */
    private $handler;

    /**
     * ChangePasswordFromEmailAction constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        UserRepository $userRepository,
        TokenStorageInterface $security,
        FormFactoryInterface $formFactory,
        ChangePasswordFromEmailHandlerInterface $handler
    ) {
        $this->userRepository = $userRepository;
        $this->security = $security;
        $this->formFactory = $formFactory;
        $this->handler = $handler;
    }


    /**
     * {@inheritdoc}
     *
     * @return mixed
     */
    public function __invoke(
        Request $request,
        ChangePasswordFromEmailResponderInterface $responder,
        $token
    ) {
        $dto = new ChangePasswordFromEmailDTO(null, $token);

        $form = $this->formFactory->create(ChangePasswordFromEmailType::class, $dto)
                                    ->handleRequest($request);

        if ($this->handler->handle($form, $request)) {
            return $responder(true);
        }

        return $responder(false, $form);
    }
}
