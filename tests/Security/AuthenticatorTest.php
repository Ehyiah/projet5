<?php

namespace App\Tests\Security;


use App\Security\Authenticator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class AuthenticatorTest
 * @group Security
 */
final class AuthenticatorTest extends TestCase
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    protected function setUp()
    {
        $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
        $this->userPasswordEncoder = $this->createMock(UserPasswordEncoderInterface::class);
    }

    public function testItImplements()
    {
        $security = new Authenticator(
            $this->userPasswordEncoder,
            $this->urlGenerator
        );

        static::assertInstanceOf(Authenticator::class, $security);
    }
}
