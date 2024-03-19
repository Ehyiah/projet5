<?php

namespace App\DataFixtures\ImageFixtures;


use App\DataFixtures\CategoryCollectionFixture\CategoryFixture;
use App\DataFixtures\CollectionFixtures\CollectionFixture;
use App\DataFixtures\ElementCollectionFixtures\ElementCollectionFixture;
use App\DataFixtures\ImageFixtures\Interfaces\ImageFixtureInterface;
use App\DataFixtures\UserFixtures\UserFixture;
use App\Domain\ValueObject\Interfaces\PictureInterface;
use App\Domain\ValueObject\Picture;
use App\Entity\ImageCollection;
use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class ImageFixture
 */
class ImageFixture extends Fixture implements ImageFixtureInterface, DependentFixtureInterface
{
    public const IMAGE_REFERENCE = 'image-reference';

    /**
     * @var ElementCollectionRepositoryInterface
     */
    private $elementRepository;

    /**
     * ImageFixture constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        ElementCollectionRepositoryInterface $elementRepository
    ) {
        $this->elementRepository = $elementRepository;
    }


    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        $picture = new Picture('test', '.test');
        $picture->getFileName();

        $image = new ImageCollection($picture);

        $manager->persist($image);
        $manager->flush();

        $this->addReference(self::IMAGE_REFERENCE, $image);
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return array(
            UserFixture::class,
            CategoryFixture::class,
        );
    }
}
