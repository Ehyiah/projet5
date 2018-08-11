<?php

namespace App\Controller\Collection;


use App\Controller\Collection\Interfaces\EditCollectionActionInterface;
use App\Domain\DTO\Collection\EditCollectionDTO;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\UI\Form\Handler\Collection\EditCollectionHandler;
use App\UI\Form\Type\Collection\EditCollectionType;
use App\UI\Responder\Collection\EditCollectionResponder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class EditCollectionAction
 * @package App\Controller\Collection
 * @Route("/editCollection/{id}", name="editCollection")
 * @Security("has_role('ROLE_USER')")
 */
class EditCollectionAction implements EditCollectionActionInterface
{
    /**
     * @var CollectionRepositoryInterface
     */
    private $collectionRepository;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * EditCollectionAction constructor.
     *
     * @param CollectionRepositoryInterface $collectionRepository
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(
        CollectionRepositoryInterface $collectionRepository,
        FormFactoryInterface $formFactory
    ) {
        $this->collectionRepository = $collectionRepository;
        $this->formFactory = $formFactory;
    }

    /**
     * @param Request $request
     * @param EditCollectionResponder $responder
     * @param EditCollectionHandler $handler
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        Request $request,
        EditCollectionResponder $responder,
        EditCollectionHandler $handler
    ) {
        $collectionObjet = $this->collectionRepository->find($request->attributes->get('id'));

        $dto = new EditCollectionDTO(
            $collectionObjet->getCollectionName(),
            $collectionObjet->getTag(),
            $collectionObjet->getCategory(),
            $collectionObjet->getHidden(),
            $collectionObjet->getImage());

        $form = $this->formFactory->create(EditCollectionType::class, $dto)
                                    ->handleRequest($request);


        $request->getSession()->set('idCollection', $request->attributes->get('id'));

        if ($handler->handle($form, $collectionObjet)) {
            $request->getSession()->getFlashBag()->add('success', 'La Collection a bien été modifiée');
            return $responder(true);
        }

        return $responder(false, $form);
    }
}