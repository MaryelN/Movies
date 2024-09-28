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
}