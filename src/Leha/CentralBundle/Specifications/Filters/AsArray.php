<?php

namespace Leha\CentralBundle\Specifications\Filters;

use Doctrine\ORM\QueryBuilder;

class AsArray implements Specification
{
    private $parent;

    public function __construct(Specification $parent)
    {
        $this->parent = $parent;
    }

    public function modifyQuery(Query $query)
    {
        $query->setHydrationMode(Query::HYDRATE_ARRAY);
    }

    public function match(QueryBuilder $qb, $dqlAlias)
    {
        return $this->parent->match($qb, $dqlAlias);
    }
}