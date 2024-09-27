<?php

namespace App\Repository;

use App\Entity\Person;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Person>
 *
 * @method Person|null find($id, $lockMode = null, $lockVersion = null)
 * @method Person|null findOneBy(array $criteria, array $orderBy = null)
 * @method Person[]    findAll()
 * @method Person[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Person::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Person $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Person $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

//    public function findByName($value)
//    {
//        return $this->createQueryBuilder('p') // p is an alias for Person（テーブル名）
//            ->where('p.name like ?1') // ?1 is a placeholder
//            ->setParameter(1, '%' . $value . '%') // set the value of the placeholder
//            ->getQuery() // Queryクラスのインスタンスを取得
//            ->getResult();
//    }

    public function findByName($value)
    {
        $arr = explode (',', $value);
        return $this->createQueryBuilder('p')
            ->where("p.name in (?1, ?2)")
            ->setParameters(array(1 => $arr[0], 2 => $arr[1]))
            ->getQuery()
            ->getResult();
    }

    public function findByAge($value)
    {
        return $this->createQueryBuilder('p')
            ->where('p.age >= ?1')
            ->setParameter(1, $value)
            ->getQuery()
            ->getResult();
    }


    // /**
    //  * @return Person[] Returns an array of Person objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Person
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
