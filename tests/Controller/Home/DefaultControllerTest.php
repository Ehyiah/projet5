<?php

namespace App\Tests\Controller\Home;


use App\Controller\Home\DefaultController;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class DefaultControllerTest
 * @group Action
 */
final class DefaultControllerTest extends KernelTestCase
{
    protected function setUp()
    {
        static::bootKernel();
    }

    public function testHomePage()
    {
        $action = new DefaultController();

        static::assertInstanceOf(DefaultController::class, $action);
    }
}
