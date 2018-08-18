<?php

namespace App\Controller\ElementCollection;


use App\Controller\ElementCollection\Interfaces\ShowCollectionDetailledActionInterface;
use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use App\UI\Responder\Collection\Interfaces\ShowCollectionDetailledResponderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ShowCollectionDetailledAction
 * @Route("/show/{idCollection}/{collectionName}", name="showDetailled")
 * @Security("has_role('ROLE_USER')")
 */
class ShowCollectionDetailledAction implements ShowCollectionDetailledActionInterface
{
    /**
     * @var ElementCollectionRepositoryInterface
     */
    private $elementCollectionRepository;

    /**
     * ShowCollectionDetailledAction constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(ElementCollectionRepositoryInterface $elementCollectionRepository)
    {
        $this->elementCollectionRepository = $elementCollectionRepository;
    }


    /**
     * {@inheritdoc}
     *
     * @return mixed
     */
    public function __invoke(
        Request $request,
        ShowCollectionDetailledResponderInterface $responder,
        $idCollection
    ) {
        $collection = $this->elementCollectionRepository->findCollectionById($idCollection);

        $request->getSession()->set('collectionName', $request->attributes->get('collectionName'));
        $request->getSession()->set('id', $request->attributes->get('idCollection'));

        if ($collection == null) {
            return $responder(true);
        }

        return $responder(false, $collection);
    }
}