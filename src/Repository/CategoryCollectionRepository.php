<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 17/05/2018
 * Time: 15:39
 */

namespace App\Repository;

use App\Entity\CategoryCollection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;


/**
 * @method CategoryCollection|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryCollection|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryCollection[]    findAll()
 * @method CategoryCollection[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryCollectionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CategoryCollection::class);
    }
}