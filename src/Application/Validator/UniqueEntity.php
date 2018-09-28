<?php

namespace App\Application\Validator;


use App\Application\Validator\Interfaces\UniqueEntityInterface;
use Symfony\Component\Validator\Constraint;

/**
 * Class UniqueEntity
 */
final class UniqueEntity extends Constraint implements UniqueEntityInterface
{
    public $message = 'Ce champ est déjà utilisé, merci d\'en essayer un autre';
}
