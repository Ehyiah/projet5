<?php

namespace App\Tests\Controller\Category;


use App\Controller\Category\NewCategoryCollectionAction;
use App\UI\Form\Handler\Interfaces\NewCategoryCollectionHandlerInterface;
use App\UI\Responder\NewImageCollectionResponder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class NewCategoryCollectionActionTest extends TestCase
{
    /**
     * @var FormFactoryInterface|null
     */
    private $formFactory;

    /**
     * @var EncoderFactoryInterface|null
     */
    private $encoderFactory;

    /**
     * @var NewCategoryCollectionHandlerInterface|null
     */
    private $formHandler;

    /**
     * @var NewImageCollectionResponder|null
     */
    private $responder;


    protected function setUp()
    {
        $this->formFactory = $this->createMock(FormFactoryInterface::class);
        $this->encoderFactory = $this->createMock(EncoderFactoryInterface::class);
        $this->formHandler = $this->createMock(NewCategoryCollectionHandlerInterface::class);
        $this->responder = $this->createMock(NewImageCollectionResponder::class);
    }

    public function testItImplements()
    {
        $action = new NewCategoryCollectionAction($this->encoderFactory, $this->formFactory);

        static::assertInstanceOf(NewCategoryCollectionAction::class, $action);
    }


}