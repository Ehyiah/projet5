<?php

namespace App\Controller\Security;


use App\Controller\Security\Interfaces\ChangePasswordActionInterface;
use App\UI\Form\Handler\Security\ChangePasswordHandler;
use App\UI\Form\Type\Security\ChangePasswordType;
use App\UI\Responder\Security\ChangePasswordResponder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * Class ChangePasswordAction
 * @package App\Controller\Security
 * @Security("has_role('ROLE_USER')")
 * @Route("/passwordChange", name="changePassword")
 */
class ChangePasswordAction implements ChangePasswordActionInterface
{
    /**
     * @SecurityAssert\UserPassword(
     *     message = "Wrong value for your current password"
     * )
     * @var string
     */
    protected $oldPassword;

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
     * ChangePasswordAction constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(FormFactoryInterface $formFactory, Environment $twig, UrlGeneratorInterface $urlGenerator)
    {
        $this->formFactory = $formFactory;
        $this->twig = $twig;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @param Request $request
     * @param ChangePasswordHandler $handler
     * @param ChangePasswordResponder $responder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        Request $request,
        ChangePasswordHandler $handler,
        ChangePasswordResponder $responder
    ) {
        $form = $this->formFactory->create(ChangePasswordType::class)
                                    ->handleRequest($request);

        if ($handler->handle($form)) {
            return $responder(true);
        }

        return $responder(false, $form);
    }
}