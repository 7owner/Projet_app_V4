<?php

namespace App\Repository;

use App\Entity\RendezVousImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RendezVousImage>
 *
 * @method RendezVousImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method RendezVousImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method RendezVousImage[]    findAll()
 * @method RendezVousImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RendezVousImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RendezVousImage::class);
    }
}
