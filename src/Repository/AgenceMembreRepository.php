<?php

namespace App\Repository;

use App\Entity\AgenceMembre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AgenceMembre>
 *
 * @method AgenceMembre|null find($id, $lockMode = null, $lockVersion = null)
 * @method AgenceMembre|null findOneBy(array $criteria, array $orderBy = null)
 * @method AgenceMembre[]    findAll()
 * @method AgenceMembre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgenceMembreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AgenceMembre::class);
    }
}
