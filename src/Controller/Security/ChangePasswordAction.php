<?php

namespace App\Controller\Security;


use App\Controller\Security\Interfaces\ChangePasswordActionInterface;
use App\UI\Form\Handler\Security\Interfaces\ChangePasswordHandlerInterface;
use App\UI\Form\Type\Security\ChangePasswordType;
use App\UI\Responder\Security\Interfaces\ChangePasswordResponderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * Class ChangePasswordAction
 * @Security("has_role('ROLE_USER')")
 * @Route("/passwordChange", name="changePassword")
 */
class ChangePasswordAction implements ChangePasswordActionInterface
{
    /**
     * @SecurityAssert\UserPassword(
     *     message = "Mauvais mot de passe Actuel"
     * )
     * @var string|null
     */
    protected $oldPassword = null;

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
     * @var ChangePasswordHandlerInterface
     */
    private $handler;

    /**
     * ChangePasswordAction constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        string $oldPassword = null,
        FormFactoryInterface $formFactory,
        Environment $twig,
        UrlGeneratorInterface $urlGenerator,
        ChangePasswordHandlerInterface $handler
    ) {
        $this->oldPassword = $oldPassword;
        $this->formFactory = $formFactory;
        $this->twig = $twig;
        $this->urlGenerator = $urlGenerator;
        $this->handler = $handler;
    }


    /**
     * {@inheritdoc}
     */
    public function __invoke(
        Request $request,
        ChangePasswordResponderInterface $responder
    ) {
        $form = $this->formFactory->create(ChangePasswordType::class)
                                    ->handleRequest($request);

        if ($this->handler->handle($form)) {
            $request->getSession()->getFlashBag()->add('success', 'Le mot de passe a bien été modifié');
            return $responder(true);
        }

        return $responder(false, $form);
    }
}