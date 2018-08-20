<?php

namespace App\Controller\Category;


use App\Controller\Category\Interfaces\SelectCollectionActionInterface;
use App\Infra\Doctrine\Repository\Interfaces\CategoryCollectionRepositoryInterface;
use App\UI\Form\Handler\Collection\Interfaces\SelectCollectionHandlerInterface;
use App\UI\Responder\Category\SelectCollectionResponder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SelectCollectionAction
 * @Route("/select", name="select")
 * @Security("has_role('ROLE_USER')")
 */
class SelectCollectionAction implements SelectCollectionActionInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var CategoryCollectionRepositoryInterface
     */
    private $categoryCollection;

    /**
     * @var SelectCollectionHandlerInterface
     */
    private $handler;

    /**
     * SelectCollectionAction constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        CategoryCollectionRepositoryInterface $categoryCollection,
        SelectCollectionHandlerInterface $handler
    ) {
        $this->formFactory = $formFactory;
        $this->categoryCollection = $categoryCollection;
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
        SelectCollectionResponder $responder
    ) {
        $form = $this->formFactory->create(\App\UI\Form\Type\Category\SelectCollectionType::class)
                                    ->handleRequest($request);

        if ($this->handler->handle($form)) {
            $request->getSession()->getFlashBag()->add('success', 'La catégorie a bien été supprimée');
            return $responder(true);
        }

        return $responder (false, $form);
    }
}