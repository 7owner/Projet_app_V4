<?php

namespace App\Repository;

use App\Entity\RapportMaintenance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RapportMaintenance>
 *
 * @method RapportMaintenance|null find($id, $lockMode = null, $lockVersion = null)
 * @method RapportMaintenance|null findOneBy(array $criteria, array $orderBy = null)
 * @method RapportMaintenance[]    findAll()
 * @method RapportMaintenance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RapportMaintenanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RapportMaintenance::class);
    }
}
