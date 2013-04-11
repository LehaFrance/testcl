<?php
namespace Leha\CentralBundle\Specifications\Filters;

use Doctrine\ORM\QueryBuilder;

class FilterAttribut implements Specification
{
    private $attribut;

    public function __construct($attribut)
    {
        $this->attribut = $attribut;
    }

    public function match(QueryBuilder $qb, $dqlAlias)
    {
        $qb->setParameter('attribut', $this->attribut);

        return $qb->expr()->eq($dqlAlias . '.attribut', ':attribut');
    }

    public function modifyQuery(Query $query)
    {

    }
}