<?php

namespace App\Application\Validator\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use Symfony\Component\Validator\Constraint;

interface UniqueEntityValidatorInterface
{
    /**
     * UniqueEntityValidatorInterface constructor.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository);

    /**
     * @param $value
     * @param Constraint $constraint
     *
     * @return mixed
     */
    public function validate($value, Constraint $constraint);
}
