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

    /**
     * Initialise le queryBuilder avec la fonct agrégative COUNT sur l'attribut primaire (aucun NULL)
     */
    private function initializeQueryBuilderWithCount(): void
    {
        $this->qb = $this->createQueryBuilder($this->alias)
            ->select("COUNT($this->alias.id)");
        // Pour ignorer les doublons
        //  ->select("COUNT(DISCTINCT $this->alias.id)");
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
// endregion **H2** QueryBuilder mobilisant des filtres et/ou des jointures
//----------------------------------------------------------

    /**
     * QueryBuilder cherchant tous les items contenant la chaîne passée en arg. "Qb" pour un queryBuilder et non la méthode
     * @param string $keyword
     * @return void
     */
private function searchQb(string $keyword): void
{
    // Recherche dans la description
    $this->orPropertyLike('description', $keyword);
    // Recherche dans le nom
    $this->orPropertyLike('name', $keyword);
}

//----------------------------------------------------------
// endregion **H2** Filtres
//----------------------------------------------------------


//**********************************************************
//endregion *H1* Méthodes retournant un QueryBuilder
//**********************************************************


//**********************************************************
//region *H1* Méthodes retournant un jeu de résultats
//**********************************************************
    public function search(string $keyword): array
    {
        $this->initializeQueryBuilder();
        $this->searchQb($keyword);
        return $this->qb->getQuery()->getResult();
    }
    public function searchCount(string $keyword): int
    {
        $this->initializeQueryBuilderWithCount();
        $this->searchQb($keyword);
        return $this->qb->getQuery()->getSingleScalarResult();
        // Permet de récupérer uniquement 1 entier
    }
}
//**********************************************************
//endregion *H1* Méthodes retournant un jeu de résultats
//**********************************************************