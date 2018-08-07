<?php

namespace App\Controller\ElementCollection;


use App\Controller\ElementCollection\Interfaces\AddElementCollectionFromCollectionActionInterface;
use App\Domain\DTO\AddElementCollectionDTO;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\UI\Form\Handler\ElementCollection\AddElementCollectionHandler;
use App\UI\Form\Type\ElementCollection\AddElementCollectionFromCollectionType;
use App\UI\Responder\ElementCollection\AddElementFromCollectionResponder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AddElementCollectionFromCollectionAction
 * @package App\Controller\ElementCollection
 * @Route("/addElement/{id}", name="addElement")
 * @Security("has_role('ROLE_USER')")
 */
class AddElementCollectionFromCollectionAction implements AddElementCollectionFromCollectionActionInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var CollectionRepositoryInterface
     */
    private $collection;

    /**
     * AddElementCollectionFromCollectionAction constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param CollectionRepositoryInterface $collection
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        CollectionRepositoryInterface $collection
    ) {
        $this->formFactory = $formFactory;
        $this->collection = $collection;
    }


    /**
     * @param Request $request
     * @param $id
     * @param AddElementCollectionHandler $handler
     * @param AddElementFromCollectionResponder $responder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        Request $request,
        $id,
        AddElementCollectionHandler $handler,
        AddElementFromCollectionResponder $responder
    ) {

    // id est l'id de la collection dans laquelle ajouter l'élément
        $collection = $this->collection->find($id);

        $dto = new AddElementCollectionDTO(null, null, null, null, null, null, null, null, $collection);

        $form = $this->formFactory->create(AddElementCollectionFromCollectionType::class, $dto)
                                    ->handleRequest($request);

        $request->getSession()->set('id', $id);


        if ($handler->handle($form)) {
            return $responder(true);
        }

        return $responder(false, $form);
    }
};
