<?php

namespace App\Tests\UI\Form\Type\Category;


use App\Domain\DTO\AddCategoryDTO;
use App\UI\Form\Type\Category\CategoryType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Test\TypeTestCase;

final class CategoryTypeTest extends TypeTestCase
{
    public function testItImplements()
    {
        $type = new CategoryType();

        static::assertInstanceOf(AbstractType::class, $type);
    }

    /**
     * @param string $category
     *
     * @dataProvider provideGoodData
     */
    public function testItAcceptData(string $category)
    {
        $type = $this->factory->create(CategoryType::class);

        $type->submit([
            'category_collection' => $category
        ]);

        static::assertTrue($type->isSubmitted());
        static::assertTrue($type->isValid());
        static::assertInstanceOf(AddCategoryDTO::class, $type->getData());
        static::assertSame($category, $type->getData()->category_collection);
    }

    /**
     * @return \Generator
     */
    public function provideGoodData()
    {
        yield array('Categorie');
        yield array('Categorie1');
        yield array('Categorie2');
    }
}