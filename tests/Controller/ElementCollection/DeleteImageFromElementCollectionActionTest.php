<?php

namespace App\Tests\Controller\ElementCollection;


use App\Controller\ElementCollection\DeleteImageFromElementCollectionAction;
use App\Domain\ValueObject\Picture;
use App\Entity\ImageCollection;
use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\ImageRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

/**
 * Class DeleteImageFromElementCollectionActionTest
 * @group Action
 */
final class DeleteImageFromElementCollectionActionTest extends KernelTestCase
{
    /**
     * @var ElementCollectionRepositoryInterface
     */
    private $elementCollectionRepository;

    /**
     * @var ImageRepositoryInterface
     */
    private $imageRepository;

    /**
     * @var Filesystem
     */
    private $fileSystem;

    protected function setUp()
    {
        static::bootKernel();

        $this->elementCollectionRepository = self::$container->get('App\Repository\ElementCollectionRepository');
        $this->imageRepository = $this->createMock(ImageRepositoryInterface::class);
        $this->fileSystem = $this->createMock(Filesystem::class);
    }

    public function testConstruct()
    {
        $action = new DeleteImageFromElementCollectionAction(
            $this->elementCollectionRepository,
            $this->imageRepository,
            $this->fileSystem
        );

        static::assertInstanceOf(
            DeleteImageFromElementCollectionAction::class,
            $action
        );
    }

    /**
     * @throws \Exception
     */
    public function testGoodHandling()
    {
        $picture = new Picture('test', 'test');
        $picture->getFileName();
        $image = new ImageCollection($picture);
        $this->imageRepository->method('findImage')->willReturn($image);

        $this->fileSystem->remove('../public/upload/CollectionImage/'.$image->getTitle());
        $this->elementCollectionRepository->removeImage($image);

        $action = new DeleteImageFromElementCollectionAction(
            $this->elementCollectionRepository,
            $this->imageRepository,
            $this->fileSystem
        );

        $request = Request::create(
            '/deleteImageFromCollection',
            'POST',
            array(),
            array(),
            array(),
            array(
                'HTTP_REFERER' => 'referer'
            )
        );
        $idElement = 'test';
        $id = 'test';

        $session = new Session(new MockArraySessionStorage());
        $request->setSession($session);
        $request->getSession()->getFlashBag()->add('success', 'L\'image a bien été supprimée de l\'Element');


        static::assertInstanceOf(
            RedirectResponse::class,
            $action($request, $idElement, $id)
        );
    }
}
