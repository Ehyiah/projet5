<?php

namespace App\Controller\Collection;


use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\UI\Form\Handler\Collection\ShowCollectionHandler;
use App\UI\Form\Type\Collection\ShowCollectionType;
use App\UI\Responder\Collection\ShowCollectionResponder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class ShowCollectionAction
 * @package App\Controller\Collection
 * @Route("/show", name="show")
 * @Security("has_role('ROLE_USER')")
 */
class ShowCollectionAction
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var CollectionRepositoryInterface
     */
    private $collectionRepository;

    /**
     * @var TokenStorageInterface
     */
    private $security;

    /**
     * ShowCollectionAction constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param CollectionRepositoryInterface $collectionRepository
     * @param TokenStorageInterface $security
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        CollectionRepositoryInterface $collectionRepository,
        TokenStorageInterface $security
    ) {
        $this->formFactory = $formFactory;
        $this->collectionRepository = $collectionRepository;
        $this->security = $security;
    }


    /**
     * @param Request $request
     * @param ShowCollectionHandler $collectionHandler
     * @param ShowCollectionResponder $responder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        Request $request,
        ShowCollectionHandler $collectionHandler,
        ShowCollectionResponder $responder
    ) {
        $form = $this->formFactory->create(ShowCollectionType::class)->handleRequest($request);

        if ($collectionHandler->handle($form)) {
            $dataUser = $this->collectionRepository->findByOwner($this->security->getToken()->getUser());

            $collections = $this->collectionRepository->findByOwnerAndCategory(
                $this->security->getToken()->getUser(),
                $form->getData()->categoryCollection
            );


            return $responder(true,null, $collections);
        }

        return $responder (false, $form, null);
    }
}