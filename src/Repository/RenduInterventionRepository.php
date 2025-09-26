<?php

namespace App\Repository;

use App\Entity\RenduIntervention;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RenduIntervention>
 *
 * @method RenduIntervention|null find($id, $lockMode = null, $lockVersion = null)
 * @method RenduIntervention|null findOneBy(array $criteria, array $orderBy = null)
 * @method RenduIntervention[]    findAll()
 * @method RenduIntervention[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RenduInterventionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RenduIntervention::class);
    }
}
