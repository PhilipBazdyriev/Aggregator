<?php

namespace App\Repository;

use App\Entity\ArticleSourcePage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArticleSourcePage|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleSourcePage|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleSourcePage[]    findAll()
 * @method ArticleSourcePage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleSourcePageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticleSourcePage::class);
    }

    /**
    * @return ArticleSourcePage[] Returns an array of ArticleSourcePage objects
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

    /**
    * @return ArticleSourcePage[] Returns an array of ArticleSourcePage objects
    */
    public function getForScanning($maxResults = 1)
    {
        return $this->createQueryBuilder('t')
            ->orderBy('t.last_scan_time', 'ASC')
            ->setMaxResults($maxResults)
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?ArticleSourcePage
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
