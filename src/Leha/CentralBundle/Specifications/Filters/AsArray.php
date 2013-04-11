<?php

namespace Leha\CentralBundle\Specifications\Filters;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query;

class AsArray implements Specification
{
    private $parent;

    public function __construct(Specification $parent)
    {
        $this->parent = $parent;
    }

    public function modifyQuery(Query $query)
    {
        //echo 'okaaa';
        //$query->setHydrationMode(Query::HYDRATE_ARRAY);
        $this->parent->modifyQuery($query);
    }

    public function match(QueryBuilder $qb, $dqlAlias)
    {
        return $this->parent->match($qb, $dqlAlias);
    }

    public function supports($className)
    {
        return false;
    }
}