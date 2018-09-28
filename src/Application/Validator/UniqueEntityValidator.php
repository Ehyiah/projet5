<?php

namespace App\Application\Validator;


use App\Application\Validator\Interfaces\UniqueEntityValidatorInterface;
use App\Entity\Interfaces\UserInterface;
use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class UniqueEntityValidator
 */
final class UniqueEntityValidator extends ConstraintValidator implements UniqueEntityValidatorInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * UniqueEntityValidator constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (\is_null($value)) {
            return;
        }

        $user = $this->userRepository->findUserByUsernameOrEmail($value);

        if ($user instanceof UserInterface) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
