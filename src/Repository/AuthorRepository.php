<?php

namespace App\Repository;

use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Author|null find($id, $lockMode = null, $lockVersion = null)
 * @method Author|null findOneBy(array $criteria, array $orderBy = null)
 * @method Author[]    findAll()
 * @method Author[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }

    public function createQueryBuilderWithBooks($limit = 25, $offset = 0): QueryBuilder
    {
        return $this->createQueryBuilder('a')
            ->addSelect('b')
            ->leftJoin('a.books', 'b')
            ->setMaxResults($limit)
            ->setFirstResult($offset);
    }

    public function findOneWithBook($id): ?Author
    {
        return $this->getEntityManager()
        ->createQuery('SELECT a,b FROM App\Entity\Author a JOIN a.books b WHERE a.id = :id')
        ->setParameter('id', $id)
        ->getSingleResult();
    }
}
