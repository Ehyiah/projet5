<?php

namespace App\Controller\Collection;


use App\Infra\Doctrine\Repository\Interfaces\CategoryRepositoryInterface;
use App\UI\Form\Handler\Collection\SelectCollectionHandler;
use App\UI\Form\Type\Collection\ShowCollectionType;
use App\UI\Responder\Collection\SelectCollectionResponder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SelectCollectionAction
 * @package App\Controller\Collection
 * @Route("/select", name="select")
 * @Security("has_role('ROLE_USER')")
 */
class SelectCollectionAction
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryCollection;

    /**
     * SelectCollectionAction constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param CategoryRepositoryInterface $categoryCollection
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        CategoryRepositoryInterface $categoryCollection
    ) {
        $this->formFactory = $formFactory;
        $this->categoryCollection = $categoryCollection;
    }


    /**
     * @param Request $request
     * @param SelectCollectionHandler $collectionHandler
     * @param SelectCollectionResponder $responder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        Request $request,
        SelectCollectionHandler $collectionHandler,
        SelectCollectionResponder $responder
    ) {
        $form = $this->formFactory->create(ShowCollectionType::class)->handleRequest($request);

        if ($collectionHandler->handle($form)) {

            $collectionCategory = $this->categoryCollection->findById($form->getData()->categoryCollection);

            $_SESSION['ShowCollectionByCategory'] = $collectionCategory;

            return $responder(true,null);
        }

        return $responder (false, $form);
    }
}