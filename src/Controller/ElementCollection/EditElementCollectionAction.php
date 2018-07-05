<?php

namespace App\Controller\ElementCollection;


use App\Entity\ElementCollection;
use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use App\UI\Form\Handler\ElementCollection\EditElementCollectionHandler;
use App\UI\Form\Type\ElementCollection\EditElementCollectionType;
use App\UI\Responder\ElementCollection\EditElementCollectionResponder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class EditElementCollectionAction
 * @package App\Controller\ElementCollection
 * @Route("/edit/{id}", name="editElementCollection")
 * @Security("has_role('ROLE_USER')")
 */
class EditElementCollectionAction
{
    /**
     * @var ElementCollectionRepositoryInterface
     */
    private $elementRepository;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * EditElementCollectionAction constructor.
     *
     * @param ElementCollectionRepositoryInterface $elementRepository
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(
        ElementCollectionRepositoryInterface $elementRepository,
        FormFactoryInterface $formFactory
    ) {
        $this->elementRepository = $elementRepository;
        $this->formFactory = $formFactory;
    }


    /**
     * @param Request $request
     * @param EditElementCollectionResponder $responder
     * @param EditElementCollectionHandler $handler
     * @param $id
     * @param ElementCollection $elementObject
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        Request $request,
        EditElementCollectionResponder $responder,
        EditElementCollectionHandler $handler,
        $id,
        ElementCollection $elementObject
    ) {
        $elementObjet = $this->elementRepository->find($id);

        $form = $this->formFactory->create(EditElementCollectionType::class)
                                    ->handleRequest($request);

            $_SESSION['idElement'] = $id;

        if ($handler->handle($form, $elementObjet)) {
            return $responder(true);
        }

        return $responder(false, $form, $elementObjet);
    }
}