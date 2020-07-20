<?php

namespace App\Repository;

use App\Entity\RechercheVoiture;
use App\Entity\Voiture;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Voiture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Voiture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Voiture[]    findAll()
 * @method Voiture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoitureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Voiture::class);
    }

    public function findAllWithPagination(RechercheVoiture $rechercheVoiture) : Query{
        // On génère et on stocke la requête de base 'v' dans la variable $req
        $req = $this->createQueryBuilder('v');
        //  Si l'année existe, on ajoute where pour filtrer sur la minAnnee
        if($rechercheVoiture->getMinAnnee()){
            $req = $req->andWhere('v.annee >= :min') // min est la valeur transmise
            // on prepare la requête 
            ->setParameter(':min', $rechercheVoiture->getMinAnnee());
        }
        if($rechercheVoiture->getMaxAnnee()){
            $req = $req->andWhere('v.annee <= :max') // max est la valeur transmise
            // on prepare la requête 
            ->setParameter(':max', $rechercheVoiture->getMaxAnnee());
        }

        return $req->getQuery();
    }
    // /**
    //  * @return Voiture[] Returns an array of Voiture objects
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
    public function findOneBySomeField($value): ?Voiture
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
