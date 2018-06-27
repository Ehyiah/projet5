<?php

namespace App\UI\Form\Handler;


use App\Entity\Collection;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\UI\Form\Handler\Interfaces\NewCollectionHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class NewCollectionHandler implements NewCollectionHandlerInterface
{
    /**
     * @var CollectionRepositoryInterface
     */
    private $collection;

    /**
     * @var TokenStorageInterface
     */
    private $token;

    /**
     * NewCollectionHandler constructor.
     *
     * @param CollectionRepositoryInterface $collection
     * @param TokenStorageInterface $token
     */
    public function __construct(CollectionRepositoryInterface $collection, TokenStorageInterface $token)
    {
        $this->collection = $collection;
        $this->token = $token;
    }


    public function handle(FormInterface $form): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            // instantiation d'une nouvelle Collection avec les bonnes data
            $newCollection = new Collection($form->getData());

            // récupération des informations de l'utilisateur connecté
            $user = $this->token->getToken()->getUser();
            $newCollection->setOwner($user);
            // insertion dans la BDD de la collection

            $this->collection->save($newCollection);

            return true;
        }

        return false;
    }
}