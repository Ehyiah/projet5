<?php

namespace App\UI\Form\Handler\Security;


use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use App\Infra\Doctrine\Repository\UserRepository;
use App\UI\Form\Handler\Security\Interfaces\PasswordRecoverInputHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Twig\Environment;

/**
 * Class PasswordRecoverInputHandler
 */
final class PasswordRecoverInputHandler implements PasswordRecoverInputHandlerInterface
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var \Swift_Mailer
     */
    private $mail;

    /**
     * PasswordRecoverInputHandler constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        Environment $twig,
        \Swift_Mailer $mail
    ) {
        $this->userRepository = $userRepository;
        $this->twig = $twig;
        $this->mail = $mail;
    }


    /**
     * {@inheritdoc}
     *
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function handle(FormInterface $form)
    {
        if ($form->isSubmitted() && $form->isValid()) {
            // on récupère le nom dans le Form
            $userName = $form->getData()->name;

            // on récupère les infos de l'user dans la BDD
            $user = $this->userRepository->findByName($userName);
            $email = $user->getEmail();

            // on génère le token pour le reset
            $token = md5(uniqid(str_rot13((string) time())));

            // on stocke le token en BDD
            $user->newResetToken($token);
            $this->userRepository->edit($user);

            //envoi du mail avec lien pour reset
            $message = (new \Swift_Message('Reset Password'))
                ->setFrom('projet5@gostiaux.net')
                ->setTo($email)
                ->setBody(
                    $this->twig->render('Email/RecoverPasswordFromEmail.html.twig', array(
                            'token' => $token
                        )
                    ), 'text/html'
                );

            $this->mail->send($message);

            return true;
        }

        return false;
    }
}
