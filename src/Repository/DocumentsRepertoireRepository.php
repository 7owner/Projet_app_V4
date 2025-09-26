<?php

namespace App\Repository;

use App\Entity\DocumentsRepertoire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DocumentsRepertoire>
 *
 * @method DocumentsRepertoire|null find($id, $lockMode = null, $lockVersion = null)
 * @method DocumentsRepertoire[]    findAll()
 * @method DocumentsRepertoire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocumentsRepertoireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DocumentsRepertoire::class);
    }
}
