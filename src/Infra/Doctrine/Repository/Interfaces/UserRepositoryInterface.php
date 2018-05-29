<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 29/05/2018
 * Time: 15:45
 */

namespace App\Infra\Doctrine\Repository\Interfaces;


use Symfony\Component\Security\Core\User\UserInterface;

interface UserRepositoryInterface
{
    public function save(UserInterface $user) : void;
}