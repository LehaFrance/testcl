<?php

namespace Leha\CentralBundle\Specifications\Filters;

use Doctrine\Orm\QueryBuilder;

interface Specification
{
    public function match(QueryBuilder $qb, $dqlAlias);

    public function modifyQuery(Query $query);
}