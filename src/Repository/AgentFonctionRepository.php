<?php

namespace App\Repository;

use App\Entity\AgentFonction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AgentFonction>
 *
 * @method AgentFonction|null find($id, $lockMode = null, $lockVersion = null)
 * @method AgentFonction|null findOneBy(array $criteria, array $orderBy = null)
 * @method AgentFonction[]    findAll()
 * @method AgentFonction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgentFonctionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AgentFonction::class);
    }
}
