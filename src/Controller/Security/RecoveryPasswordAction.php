<?php

namespace App\Controller\Security;


use App\Infra\Doctrine\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Twig\Environment;

/**
 * Class RecoveryPasswordAction
 * @package App\Controller\Security
 * @Route("/recoverPassword", name="recoverPassword")
 * @Security("has_role('ROLE_USER')")
 */
class RecoveryPasswordAction
{

    /**
     * @var \Swift_Mailer
     */
    private $mail;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @var TokenStorageInterface
     */
    private $security;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * RecoveryPasswordAction constructor.
     *
     * @param \Swift_Mailer $mail
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     * @param TokenStorageInterface $security
     * @param UserRepository $userRepository
     */
    public function __construct(\Swift_Mailer $mail, Environment $twig, UrlGeneratorInterface $urlGenerator, TokenStorageInterface $security, UserRepository $userRepository)
    {
        $this->mail = $mail;
        $this->twig = $twig;
        $this->urlGenerator = $urlGenerator;
        $this->security = $security;
        $this->userRepository = $userRepository;
    }


    /**
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke()
    {

        $message = (new \Swift_Message('test', 'body'))
            ->setFrom('projet5@gostiaux.net')
            ->setTo('rei_eva@hotmail.com')
        ;


        //generation du token
        $token = md5(uniqid(str_rot13((string) time())));

        //sauvegarde du token dans la BDD
        $user = $this->security->getToken()->getUser();
        $user->editToken($token);
        $this->userRepository->edit($user);



        //envoie du mail pour réinitialiser le mot de passe aprés vérif du token
        dump($token);
        die();



        $this->mail->send($message);


        return new Response($this->twig->render('home.html.twig')) ;

    }

}