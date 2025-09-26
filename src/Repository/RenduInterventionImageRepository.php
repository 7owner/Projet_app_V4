<?php

namespace App\Repository;

use App\Entity\RenduInterventionImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RenduInterventionImage>
 *
 * @method RenduInterventionImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method RenduInterventionImage[]    findAll()
 * @method RenduInterventionImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RenduInterventionImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RenduInterventionImage::class);
    }
}
