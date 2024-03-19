<?php

namespace App\DataFixtures\CategoryCollectionFixture;


use App\DataFixtures\UserFixtures\UserFixture;
use App\Domain\DTO\Category\AddCategoryDTO;
use App\Entity\CategoryCollection;
use App\Repository\CategoryCollectionRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class CategoryFixture
 */
class CategoryFixture extends Fixture implements DependentFixtureInterface
{
    public const CATEGORY_REFERENCE = 'category-reference';

    /**
     * @var CategoryCollectionRepository
     */
    private $categoryRepository;

    /**
     * CategoryFixture constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(CategoryCollectionRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        $categoryDTO = new AddCategoryDTO('testCategorieFixture');
        $category = new CategoryCollection($categoryDTO);
        $category1 = new CategoryCollection($categoryDTO);

        $manager->persist($category);
        $manager->flush();

        $manager->persist($category1);
        $manager->flush();

        $this->addReference(self::CATEGORY_REFERENCE, $category);
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return array(
            UserFixture::class
        );
    }
}
