<?php

namespace App\Repository;

use App\Entity\Doe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Doe>
 *
 * @method Doe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Doe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Doe[]    findAll()
 * @method Doe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Doe::class);
    }
}
