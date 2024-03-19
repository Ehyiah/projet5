<?php

namespace App\Controller\Category;


use App\Controller\Category\Interfaces\SelectCollectionActionInterface;
use App\Repository\CategoryCollectionRepository;
use App\UI\Form\Handler\Collection\Interfaces\SelectCollectionHandlerInterface;
use App\UI\Form\Handler\Collection\SelectCollectionHandler;
use App\UI\Responder\Category\SelectCollectionResponder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/select", name="select")
 * @IsGranted("ROLE_USER")
 */
class SelectCollectionAction
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var CategoryCollectionRepository
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
        CategoryCollectionRepository $categoryCollection,
        SelectCollectionHandler $handler
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
