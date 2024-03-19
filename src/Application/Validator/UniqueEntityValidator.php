<?php

namespace App\Application\Validator;


use App\Entity\Interfaces\UserInterface;
use App\Repository\UserRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class UniqueEntityValidator
 */
final class UniqueEntityValidator extends ConstraintValidator
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UniqueEntityValidator constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(UserRepository $userRepository)
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
