<?php

namespace App\Controller\ElementCollection;

use App\Controller\ElementCollection\Interfaces\EditElementCollectionActionInterface;
use App\Domain\DTO\AddElementImageDTO;
use App\Domain\DTO\ElementCollection\EditElementCollectionDTO;
use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use App\Repository\ElementCollectionRepository;
use App\UI\Form\Handler\ElementCollection\Interfaces\EditElementCollectionHandlerInterface;
use App\UI\Form\Type\ElementCollection\EditElementCollectionType;
use App\UI\Responder\ElementCollection\EditElementCollectionResponder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class EditElementCollectionAction
 * @Route("/edit/{id}", name="editElementCollection")
 * @IsGranted("ROLE_USER")
 */
class EditElementCollectionAction
{
    /**
     * @var ElementCollectionRepository
     */
    private $elementRepository;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var EditElementCollectionHandlerInterface
     */
    private $handler;

    /**
     * EditElementCollectionAction constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        ElementCollectionRepository $elementRepository,
        FormFactoryInterface $formFactory,
        EditElementCollectionHandlerInterface $handler
    ) {
        $this->elementRepository = $elementRepository;
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
        EditElementCollectionResponder $responder,
        $id
    ) {
        $elementObjet = $this->elementRepository->find($id);
        $imageCollection =[];

        foreach ($elementObjet->getImages()->toArray() as $image) {
            $imageCollection[] = new AddElementImageDTO($image);
        }

        $dto = new EditElementCollectionDTO(
            $elementObjet->getTitle(),
            $elementObjet->getRegion(),
            $elementObjet->getAuthor(),
            $elementObjet->getPublisher(),
            $elementObjet->getEtat(),
            $elementObjet->getBuyPrice(),
            $elementObjet->getSupport(),
            $elementObjet->getPlayerNumber(),
            $elementObjet->getValue(),
            $elementObjet->getCollectionName(),
            $imageCollection
        );

        $form = $this->formFactory->create(EditElementCollectionType::class, $dto)
                                    ->handleRequest($request);

        $request->getSession()->set('idElement', $request->attributes->get('id'));
        $collectionName = $elementObjet->getCollectionName();
        $request->getSession()->set('collectionName', $collectionName->getCollectionName());
        $request->getSession()->set('idCollection', $collectionName->getId());

        if ($this->handler->handle($form, $elementObjet)) {
            $request->getSession()->getFlashBag()->add('success', 'L\'élément a bien été modifié');
            return $responder(true);
        }

        return $responder(false, $form);
    }
}
