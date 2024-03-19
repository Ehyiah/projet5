<?php

namespace App\DataFixtures\UserFixtures;


use App\DataFixtures\UserFixtures\Interfaces\UserFixtureInterface;
use App\Domain\DTO\Security\AddUserDTO;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

/**
 * Class UserFixture
 */
class UserFixture extends Fixture implements UserFixtureInterface
{
    public const USER_REFERENCE = 'user-reference';

    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    /**
     * UserFixture constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }


    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        $encoder = $this->encoderFactory->getEncoder(User::class);
        $passwordEncoded = $encoder->encodePassword('test00', null);

        $userDTO = new AddUserDTO(
            'test',
            $passwordEncoded,
            'test@test.fr'
        );

        $user = new User($userDTO);
        $user->addRoleAdmin();
        $user->newResetToken('1');
        $manager->persist($user);
        $manager->flush();

        $this->addReference(self::USER_REFERENCE, $user);
    }
}
