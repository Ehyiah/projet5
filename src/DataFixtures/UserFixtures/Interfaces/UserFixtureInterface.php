<?php

namespace App\DataFixtures\UserFixtures\Interfaces;


use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

interface UserFixtureInterface
{
    /**
     * UserFixtureInterface constructor.
     *
     * @param EncoderFactoryInterface $encoderFactory
     */
    public function __construct(EncoderFactoryInterface $encoderFactory);

    /**
     * @param ObjectManager $manager
     *
     * @return mixed
     */
    public function load(ObjectManager $manager);
}
