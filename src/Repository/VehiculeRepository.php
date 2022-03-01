<?php

namespace App\Repository;

use App\Entity\Vehicule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\ResultSetMapping;
/**
 * @method Vehicule|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vehicule|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vehicule[]    findAll()
 * @method Vehicule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehiculeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vehicule::class);
    }

    // /**
    //  * @return Vehicule[] Returns an array of Vehicule objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vehicule
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }*/

 public function findOneById($value): ?Vehicule
    {
        return $this->createQueryBuilder('vehicule')
            ->andWhere('vehicule.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

 
    public function findOneByVIN($value): ?Vehicule
    {
        return $this->createQueryBuilder('vehicule')
            ->andWhere('vehicule.vin = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    // public function findByYears($value): ?Vehicule
    // {
    //     return $this->createQueryBuilder('vehicule')
    //         ->andWhere('vehicule.annee = :val')
    //         ->setParameter('val', $value)
    //         ->getQuery()
    //         ->getResult()
          
    //     ;
    // } 
    
    public function findByYear($value)
    {
        
        $query = $this->createQueryBuilder('vehicule')
                ->andWhere('vehicule.annee = :val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getResult()
              
            ;
            // $rsm = new ResultSetMapping();

    // $query = $entityManager->createNativeQuery('SELECT * FROM vehicule WHERE vehicule.annee = :val', $rsm);
    // $query->setParameter('val', $value);
    $vehicule  = new vehicule ;
    $vehicule = $query ;
          
         return $vehicule ;   
    }
    

    public function findByNumInv($value) 
    {
        $query = $this->createQueryBuilder('vehicule')
            ->andWhere('vehicule.numinventaire = :val')
            ->setParameter('val', $value)
            ->getQuery()
              
            ->getResult()
        ;
        $vehicule  = new vehicule ;
        $vehicule = $query ;
              
             return $vehicule ;   
    }

    public function findBystatus($value) 
    {
        $query = $this->createQueryBuilder('vehicule')
            ->andWhere('vehicule.status = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;

        $vehicule  = new vehicule ;
        $vehicule = $query ;
              
             return $vehicule ;   
    }


    public function findByUser($value) 
    {
        $query = $this->createQueryBuilder('vehicule')
            ->andWhere('vehicule.utilisateur = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;

        $vehicule  = new vehicule ;
        $vehicule = $query ;
              
             return $vehicule ;   
    }


    public function findByMarque($value) 
    {
        $query =  $this->createQueryBuilder('vehicule')
            ->andWhere('vehicule.marque = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;

        $vehicule  = new vehicule ;
        $vehicule = $query ;
              
             return $vehicule ;   
    }


    public function findByModel($value) 
    {
        $query = $this->createQueryBuilder('vehicule')
            ->andWhere('vehicule.modele = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;

        $vehicule  = new vehicule ;
        $vehicule = $query ;
              
             return $vehicule ;   
    }


    

}
