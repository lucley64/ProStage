<?php

namespace App\Repository;

use App\Entity\Entreprise;
use App\Entity\Stage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Stage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stage[]    findAll()
 * @method Stage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stage::class);
    }

    // /**
    //  * @return Stage[] Returns an array of Stage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Stage
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @return Stages[] Retourne un tableau de stage avec l'entreprise qui les a proposé.
     */
    public function findStagesAvecEntreprises()
    {

        $gestionnaireEntite = $this->getEntityManager();

        $requete = $gestionnaireEntite->createQuery(
            'SELECT s, e
            FROM App\Entity\Stage s
            JOIN s.entreprise e'
        );

        return $requete->execute();
    }

    /**
     * @param string $nomEntreprise Le nom de l'entreprise pour laquelle on veut récupérer les stages.
     * @return Stages[] Retourne un tableau de stage de l'entreprise qui les a proposé.
     */
    public function findStagesPourUneEntreprise(string $nomEntreprise)
    {
        return $this->createQueryBuilder('s')
                    ->join('s.entreprise', 'e')
                    ->where('e.nom = :nomEntreprise')
                    ->setParameter('nomEntreprise', $nomEntreprise)
                    ->getQuery()
                    ->getResult();
    }


    /**
     * @param string $nomFormation Le nom de la formation pour laquelle on veut récupérer les stages.
     * @return Stages[] Retourne un tableau de stage concernant la formation donnée.
     */
    public function findStagesPourUneFormation(string $nomFormation)
    {
        $gestionnaireEntite = $this->getEntityManager();

        $requete = $gestionnaireEntite->createQuery(
            "SELECT s
            FROM App\Entity\Stage s
            JOIN s.formations f
            WHERE f.nom = '$nomFormation'"
        );

        return $requete->execute();
    }
}
