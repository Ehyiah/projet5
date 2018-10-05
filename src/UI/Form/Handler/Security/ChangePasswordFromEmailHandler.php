<?php

namespace App\UI\Form\Handler\Security;


use App\Entity\User;
use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Form\Handler\Security\Interfaces\ChangePasswordFromEmailHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

/**
 * Class ChangePasswordFromEmailHandler
 */
final class ChangePasswordFromEmailHandler implements ChangePasswordFromEmailHandlerInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * ChangePasswordFromEmailHandler constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        EncoderFactoryInterface $encoderFactory,
        SessionInterface $session
    ) {
        $this->userRepository = $userRepository;
        $this->encoderFactory = $encoderFactory;
        $this->session = $session;
    }


    /**
     * {@inheritdoc}
     */
    public function handle(FormInterface $form)
    {
        // on récupère les infos de l'utilisateur et on change le MDP en BDD
        if ($form->isSubmitted() && $form->isValid()) {

            // récupération des infos du form : token et nouveau MDP
            $token = $form->getData()->token;
            $newPass = $form->getData()->password;

            // sélection de l'utilisateur par le token en BDD
            $user = $this->userRepository->findByToken($token);

            // récupération de la date de fin de validité du token
            $tokenDate = $user->getTokenValidity();

            // création d'un token now
            $now = new \DateTime('now');

            // vérification que le token n'est pas expiré
            if ($now > $tokenDate) {
                // token n'est plus valide => impossibilité de changer le MDP
                $this->session->getFlashBag()->add('notice', 'le token n\'est plus valide, impossible de changer le mot de passe');

            } else {
                // token valide => changement du mot de passe possible
                $this->session->getFlashBag()->add('success', 'Le mot de passe a bien été changé');

                $encoder = $this->encoderFactory->getEncoder(User::class);

                $newPassEncoded = $encoder->encodePassword($newPass, null);
                $user->editPassword($newPassEncoded);
                $this->userRepository->edit($user);

            }

            return true;
        }

        return false;
    }
}
