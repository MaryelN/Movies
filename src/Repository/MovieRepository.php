<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Movie>
 *
 * @method Movie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Movie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Movie[]    findAll()
 * @method Movie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
    }

//    /**
//     * @return Movie[] Returns an array of Movie objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Movie
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    public function findMovies($genreId = null)
    {
        $queryBuilder = $this->createQueryBuilder('m')
            ->leftJoin('m.genre', 'g');
        if ($genreId !== null) {
            $queryBuilder->Where('g.id = :genreId')
                ->setParameter('genreId', $genreId);
        }
        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * Récupère les films en lien avec la recherche
     *
     * @param SearchData $data
     * @return Movie[]
     */
    public function findSearch(SearchData $search): array
    {
        $query = $this
            ->createQueryBuilder('m')
            ->select('g', 'm')
            ->join('m.genre', 'g');
    
        if (!empty($search->q)) {
            $query = $query
                ->andWhere('m.name LIKE :q')
                ->setParameter('q', "%{$search->q}%");
        }
    
        if (!empty($search->min)) {
            $query = $query
                ->andWhere('m.releaseDate >= :min')
                ->setParameter('min', $search->min);
        }
        
        if (!empty($search->max)) {
            $query = $query
                ->andWhere('m.releaseDate <= :max')
                ->setParameter('min', $search->max);
        }

        if (!empty($search->genre)) {
            $query = $query
                ->andWhere('g.id IN (:genres)')
                ->setParameter('genres', $search->genre);
        }

        return $query->getQuery()->getResult();
    }
}