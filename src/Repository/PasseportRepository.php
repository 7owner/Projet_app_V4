<?php

namespace App\Repository;

use App\Entity\Passeport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Passeport>
 *
 * @method Passeport|null find($id, $lockMode = null, $lockVersion = null)
 * @method Passeport|null findOneBy(array $criteria, array $orderBy = null)
 * @method Passeport[]    findAll()
 * @method Passeport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PasseportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Passeport::class);
    }
}
