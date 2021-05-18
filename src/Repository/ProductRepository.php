<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function searchByTerm($search)/*je créé une fonction qui va rechercher des mots rentrée par l'utilisateur*/
    {
        /*
         * je stock dans une variable le résultat de createQueryBuilder sur la table alias 'p'(pour product)
         * query builder traduit une requête php en sql, pour créer ses propres requêtes
        */
        $queryBuilder = $this->createQueryBuilder('p');
        $query = $queryBuilder
            //je fais un SELECT sur l'alias 'p'(table product)
            ->select('p')
            //si le content
            ->where('p.description LIKE :search')
            //ou le title contiennent un équivalent de la recherche dans 'search'
            ->orWhere('p.name LIKE :search')
            // j'indique que search correspond à la variable $search (donc la recherche du user) entre deux '%' pour rechercher
            // une similitude n'importe ou dans le contenu ou le title (LIKE SQL)
            ->setParameter('search', '%'.$search.'%')
            //je récupère ma requête
            ->getQuery();
        //et je retourne le résultat
        return $query -> getResult();
    }
}
