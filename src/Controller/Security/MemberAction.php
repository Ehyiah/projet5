<?php

namespace App\Controller\Security;

use App\Controller\Security\Interfaces\MemberActionInterface;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\ImageRepositoryInterface;
use App\UI\Responder\Interfaces\MemberResponderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Twig\Environment;

/**
 * Class MemberAction
 * @Route("/member", name="member")
 * @IsGranted("ROLE_USER")
 */
class MemberAction implements MemberActionInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var ImageRepositoryInterface
     */
    private $imageRepository;

    /**
     * @var CollectionRepositoryInterface
     */
    private $collection;

    /**
     * @var TokenStorageInterface
     */
    private $security;


    /**
     * MemberAction constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        Environment $twig,
        ImageRepositoryInterface $imageRepository,
        CollectionRepositoryInterface $collection,
        TokenStorageInterface $security
    ) {
        $this->twig = $twig;
        $this->imageRepository = $imageRepository;
        $this->collection = $collection;
        $this->security = $security;
    }


    /**
     * {@inheritdoc}
     */
    public function __invoke(
        Request $request,
        MemberResponderInterface $responder
    ) {
        $user = $this->security->getToken()->getUser();

        $collection = $this->collection->FindCollectionForMemberPage($user);

        $tabToCount = [];

        foreach ($collection as $cat) {
            $tabToCount[] = $cat->getCategory()->getCategoryCollection();
        }

        $tabCount = array_count_values($tabToCount);

        $tab['user'] = $user;
        $tab['count'] = $tabCount;
        $tab['collection'] = $collection;

        return $responder(false, $tab);
    }
}
