<?php

namespace App\Controller\Collection;


use App\Controller\Collection\Interfaces\NewCollectionActionInterface;
use App\UI\Form\Type\Collection\CreateCollectionType;
use App\UI\Form\Handler\Interfaces\NewCollectionHandlerInterface;
use App\UI\Responder\NewCollectionResponder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class NewCollectionAction
 * @Route("/newCollection", name="newCollection")
 * @Security("has_role('ROLE_USER')")
 */
class NewCollectionAction implements NewCollectionActionInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var NewCollectionHandlerInterface
     */
    private $handler;

    /**
     * NewCollectionAction constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        NewCollectionHandlerInterface $handler
    ) {
        $this->formFactory = $formFactory;
        $this->handler = $handler;
    }


    /**
     * {@inheritdoc}
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        Request $request,
        NewCollectionResponder $responder
    ): Response {
        $form = $this->formFactory->create(CreateCollectionType::class)->handleRequest($request);

        if ($this->handler->handle($form)) {
            $request->getSession()->getFlashBag()->add('success', 'La collection a bien été ajoutée');
            return $responder(true);
        }

        return $responder(false, $form);
    }
}
