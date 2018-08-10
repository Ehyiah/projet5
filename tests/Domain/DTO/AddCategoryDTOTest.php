<?php

namespace App\Tests\Domain\DTO;

use App\Domain\DTO\AddCategoryDTO;
use PHPUnit\Framework\TestCase;

final class AddCategoryDTOTest extends TestCase
{
    /**
     * @param string $category
     *
     * @dataProvider provideCategory
     */
    public function testItImplements(string $category)
    {
        $dto = new AddCategoryDTO($category);

        static::assertInstanceOf(AddCategoryDTO::class, $dto);
    }

    /**
     * @return \Generator
     */
    public function provideCategory()
    {
        yield array('Categorie');
    }
}