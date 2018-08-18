<?php

namespace App\Controller\Collection;


use App\Controller\Collection\Interfaces\EditCollectionActionInterface;
use App\Domain\DTO\Collection\EditCollectionDTO;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\UI\Form\Handler\Collection\Interfaces\EditCollectionHandlerInterface;
use App\UI\Form\Type\Collection\EditCollectionType;
use App\UI\Responder\Collection\Interfaces\EditCollectionResponderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class EditCollectionAction
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
     * @var EditCollectionHandlerInterface
     */
    private $handler;

    /**
     * EditCollectionAction constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        CollectionRepositoryInterface $collectionRepository,
        FormFactoryInterface $formFactory,
        EditCollectionHandlerInterface $handler
    ) {
        $this->collectionRepository = $collectionRepository;
        $this->formFactory = $formFactory;
        $this->handler = $handler;
    }


    /**
     * {@inheritdoc}
     *
     * @return mixed
     */
    public function __invoke(
        Request $request,
        EditCollectionResponderInterface $responder
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

        if ($this->handler->handle($form, $collectionObjet)) {
            $request->getSession()->getFlashBag()->add('success', 'La Collection a bien été modifiée');
            return $responder(true);
        }

        return $responder(false, $form);
    }
}