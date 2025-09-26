<?php

namespace App\Repository;

use App\Entity\AgentEquipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AgentEquipe>
 *
 * @method AgentEquipe|null find($id, $lockMode = null, $lockVersion = null)
 * @method AgentEquipe|null findOneBy(array $criteria, array $orderBy = null)
 * @method AgentEquipe[]    findAll()
 * @method AgentEquipe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgentEquipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AgentEquipe::class);
    }
}
