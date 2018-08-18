<?php

namespace App\UI\Responder;


use App\UI\Responder\Interfaces\MemberResponderInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * Class MemberResponder
 */
class MemberResponder implements MemberResponderInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * MemberResponder constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke($redirect =false, array $collections)
    {
        $redirect
            ? $response = new RedirectResponse('home')
            : $response = new Response(
                $this->twig->render('Member/member.html.twig', array(
                    'test' => 'bonjour',
                    'collections' => $collections
                ))
        );

        return $response;
    }
}
