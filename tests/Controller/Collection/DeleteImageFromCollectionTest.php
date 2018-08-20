<?php

namespace App\Tests\Controller\Collection;


use App\Controller\Collection\DeleteImageFromCollection;
use App\Domain\ValueObject\Picture;
use App\Entity\ImageCollection;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\ImageRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

final class DeleteImageFromCollectionTest extends KernelTestCase
{
    /**
     * @var CollectionRepositoryInterface
     */
    private $collectionRepository;

    /**
     * @var ImageRepositoryInterface
     */
    private $imageRepository;

    protected function setUp()
    {
        static::bootKernel();

        $this->collectionRepository = $this->createMock(CollectionRepositoryInterface::class);
        $this->imageRepository = $this->createMock(ImageRepositoryInterface::class);
    }

    public function testConstruct()
    {
        $action = new DeleteImageFromCollection(
            $this->collectionRepository,
            $this->imageRepository
        );

        static::assertInstanceOf(DeleteImageFromCollection::class, $action);
    }

    /**
     * @throws \Exception
     */
    public function testGoodDeleting()
    {
        $picture = new Picture('test', 'test');
        $image = new ImageCollection($picture);

        $this->imageRepository->method('findImage')->willReturn($image);
        $id = 'test';

        $action = new DeleteImageFromCollection(
            $this->collectionRepository,
            $this->imageRepository
        );

        $request = Request::create(
            '/deleteImage',
            'POST'
        );

        $session = new Session(new MockArraySessionStorage());
        $request->setSession($session);
        $request->getSession()->getFlashBag()->add('success', 'L\'image a bien été supprimée');

        $request->headers->set('referer', '/home');

        static::assertInstanceOf(
            RedirectResponse::class,
            $action($request, $id)
        );
    }
}
