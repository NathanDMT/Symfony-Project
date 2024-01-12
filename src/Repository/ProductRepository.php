<?php

namespace App\Repository;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

class ProductRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * @var QueryBuilder $qb queryBuilder utilisé dans les diff méthodes
     */
    private QueryBuilder $qb;

    /**
     * @var string $alias pour l'entité manipulée
     */
    private string $alias = 'pdt';

//**********************************************************
//region *H1* Méthodes retournant un QueryBuilder
//**********************************************************


//----------------------------------------------------------
// region **H2** Initialisation du queryBuilder
//----------------------------------------------------------
    /**
     * Initialisation du querybuilder courant (var $qb)
     */
    private function initializeQueryBuilder(): void
    {
        $this->qb = $this->createQueryBuilder($this->alias)
            ->select($this->alias);
    }
//----------------------------------------------------------
// endregion **H2** Initialisation du queryBuilder
//----------------------------------------------------------


//----------------------------------------------------------
// region **H2** Filtres
//----------------------------------------------------------

    /**
     * Filtre sur une propriété avec l'op LIKE à partir de la chaine passé en arg
     * @param string $propertyName
     * @param string $keyword
     * @return void
     */
    private function orPropertyLike(string $propertyName, string $keyword): void
    {
        $this->qb->orWhere("$this->alias.$propertyName LIKE :$propertyName")
            ->setParameter($propertyName, '%' . $keyword . '%');
    }
//----------------------------------------------------------
// endregion **H2** Filtres
//----------------------------------------------------------


//**********************************************************
//endregion *H1* Méthodes rtournant un QueryBuilder
//**********************************************************

    public function search(string $keyword): array
    {
        $this->initializeQueryBuilder();
        // Recherche dans la description
        $this->orPropertyLike('description', $keyword);
        // Recherche dans le nom
        $this->orPropertyLike('name', $keyword);
        // Recherche dans le prix
        $this->orPropertyLike('price', $keyword);
        return $this->qb->getQuery()->getResult();
    }
}