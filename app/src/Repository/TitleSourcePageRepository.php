<?php

namespace App\Repository;

use App\Entity\TitleSourcePage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TitleSourcePage|null find($id, $lockMode = null, $lockVersion = null)
 * @method TitleSourcePage|null findOneBy(array $criteria, array $orderBy = null)
 * @method TitleSourcePage[]    findAll()
 * @method TitleSourcePage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TitleSourcePageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TitleSourcePage::class);
    }

    /**
    * @return TitleSourcePage[] Returns an array of TitleSourcePage objects
    */
    public function findByUrl($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.url = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?TitleSourcePage
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
