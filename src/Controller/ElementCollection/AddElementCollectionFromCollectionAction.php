<?php

namespace App\Controller\ElementCollection;


use App\Controller\ElementCollection\Interfaces\AddElementCollectionFromCollectionActionInterface;
use App\Domain\DTO\ElementCollection\AddElementCollectionDTO;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\UI\Form\Handler\ElementCollection\Interfaces\AddElementCollectionHandlerInterface;
use App\UI\Form\Type\ElementCollection\AddElementCollectionFromCollectionType;
use App\UI\Responder\ElementCollection\AddElementFromCollectionResponder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AddElementCollectionFromCollectionAction
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
     * @var AddElementCollectionHandlerInterface
     */
    private $handler;

    /**
     * AddElementCollectionFromCollectionAction constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        CollectionRepositoryInterface $collection,
        AddElementCollectionHandlerInterface $handler
    ) {
        $this->formFactory = $formFactory;
        $this->collection = $collection;
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
        $id,
        AddElementFromCollectionResponder $responder
    ) {

    // id est l'id de la collection dans laquelle ajouter l'élément
        $collection = $this->collection->find($id);

        $dto = new AddElementCollectionDTO(null, null,null, null, null, null, null, null, null, $collection);

        $form = $this->formFactory->create(AddElementCollectionFromCollectionType::class, $dto)
                                    ->handleRequest($request);

        $request->getSession()->set('id', $id);


        if ($this->handler->handle($form)) {
            $request->getSession()->getFlashBag()->add('success', 'L\'élément a bien été ajoutée à la collection');
            return $responder(true);
        }

        return $responder(false, $form);
    }
};
