<?php

namespace App\Tests\Controller\Security;


use App\Controller\Security\MemberAction;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\ImageRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Responder\Interfaces\MemberResponderInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Twig\Environment;

/**
 * Class MemberActionTest
 */
final class MemberActionTest extends KernelTestCase
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var ImageRepositoryInterface
     */
    private $imageRepository;

    /**
     * @var CollectionRepositoryInterface
     */
    private $collection;

    /**
     * @var TokenStorageInterface
     */
    private $security;

    /**
     * @var MemberResponderInterface
     */
    private $responder;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    protected function setUp()
    {
        static::bootKernel();
        $this->twig = $this->createMock(Environment::class);
        $this->imageRepository = self::$container->get('App\Infra\Doctrine\Repository\Interfaces\ImageRepositoryInterface');
        $this->collection = self::$container->get('App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface');
        $this->security = $this->createMock(TokenStorageInterface::class);
        $this->responder = self::$container->get('App\UI\Responder\Interfaces\MemberResponderInterface');
        $this->userRepository = self::$container->get('App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface');
    }


    public function testConstruct()
    {
        $action = new MemberAction(
            $this->twig,
            $this->imageRepository,
            $this->collection,
            $this->security
        );

        static::assertInstanceOf(MemberAction::class, $action);
    }

    public function testGoodHandling()
    {
        $user = $this->userRepository->findAll();
        $this->security->method('getToken')->willReturn($user[0]);

        $action = new MemberAction(
            $this->twig,
            $this->imageRepository,
            $this->collection,
            $this->security
        );

        $request = Request::create(
            '/member',
            'POST'
        );

        static::assertInstanceOf(
            Response::class,
            $action($request, $this->responder)
        );
    }
}
