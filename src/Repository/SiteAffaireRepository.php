<?php

namespace App\Repository;

use App\Entity\SiteAffaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SiteAffaire>
 *
 * @method SiteAffaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method SiteAffaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method SiteAffaire[]    findAll()
 * @method SiteAffaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SiteAffaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SiteAffaire::class);
    }
}
