<?php

namespace App\Tests\UI\Form\Type\Category;


use App\UI\Form\Type\Category\CategoryType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Test\TypeTestCase;

class CategoryTypeTest extends TypeTestCase
{
    public function testItImplements()
    {
        $type = new CategoryType();

        static::assertInstanceOf(AbstractType::class, $type);
        static::assertInstanceOf(CategoryType::class, $type);
    }

    /**
     * @param string $category
     *
     * @dataProvider provideData
     */
    public function testItAcceptData(string $category)
    {
        $type = $this->factory->create(CategoryType::class);

        $type->submit([
            'category_collection' => $category
        ]);

        static::assertTrue($type->isSubmitted());
        static::assertTrue($type->isValid());
        static::assertSame($category, $type->getData()->category_collection);
    }

    /**
     * @return \Generator
     */
    public function provideData()
    {
        yield array('Categorie');
        yield array('Categorie1');
        yield array('Categorie2');
    }
}