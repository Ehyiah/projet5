<?php

namespace App\DataFixtures\ElementCollectionFixtures;


use App\DataFixtures\CategoryCollectionFixture\CategoryFixture;
use App\DataFixtures\CollectionFixtures\CollectionFixture;
use App\DataFixtures\ElementCollectionFixtures\Interfaces\ElementCollectionFixtureInterface;
use App\DataFixtures\ImageFixtures\ImageFixture;
use App\DataFixtures\UserFixtures\UserFixture;
use App\Domain\DTO\ElementCollection\AddElementCollectionDTO;
use App\Entity\ElementCollection;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class ElementCollectionFixture
 */
class ElementCollectionFixture extends Fixture implements ElementCollectionFixtureInterface, DependentFixtureInterface
{
    public const ELEMENT_REFERENCE = 'element-reference';

    /**
     * @var ElementCollectionRepositoryInterface
     */
    private $elementCollectionRepository;

    /**
     * @var CollectionRepositoryInterface
     */
    private $collectionRepository;

    /**
     * ElementCollectionFixture constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        ElementCollectionRepositoryInterface $elementCollectionRepository,
        CollectionRepositoryInterface $collectionRepository
    ) {
        $this->elementCollectionRepository = $elementCollectionRepository;
        $this->collectionRepository = $collectionRepository;
    }


    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        $collection = $this->collectionRepository->findAll();

        $elementCollectionDTO = new AddElementCollectionDTO(
            'titreElement', 'regionElement','author', 'publisherElement',
            'etatElement', 12, 'support', 2,
            12, $collection[0], []
        );
        $elementCollection = new ElementCollection($elementCollectionDTO);

        $manager->persist($elementCollection);
        $manager->flush();


        $elementCollectionDTO0 = new AddElementCollectionDTO(
            'titreElement', 'regionElement','author', 'publisherElement',
            'etatElement', 12, 'support', 2,
            12, $collection[0], []
        );
        $elementCollection0 = new ElementCollection($elementCollectionDTO0);

        $manager->persist($elementCollection0);
        $manager->flush();


        //$this->addReference(self::ELEMENT_REFERENCE, $elementCollection);
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return array(
            UserFixture::class,
            CategoryFixture::class,
            CollectionFixture::class,
            ImageFixture::class
        );
    }
}
