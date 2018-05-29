<?php

namespace App\UI\Action;


use App\Domain\Builder\Interfaces\UserBuilderInterface;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class RegistrationAction
{
    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    /**
     * @var UserBuilderInterface
     */
    private $userBuilder;

    /**
     * RegistrationAction constructor.
     * @param EncoderFactoryInterface $encoderFactory
     * @param UserBuilderInterface $userBuilder
     */
    public function __construct(EncoderFactoryInterface $encoderFactory, UserBuilderInterface $userBuilder)
    {
        $this->encoderFactory = $encoderFactory;
        $this->userBuilder = $userBuilder;
    }

    public function __invoke()
    {
        $user = $this->userBuilder->createFromRegistration(
            'Toto',
            'tot@gmail.com',
            'azerty',
            \Closure::fromCallable([$encoder, 'encodePassword'])
            );


        $encoder = $this->encoderFactory->getEncoder(User::class);


    }
}