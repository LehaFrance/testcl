<?php

namespace Leha\CentralBundle\Specifications\Filters;

use Doctrine\Orm\QueryBuilder;
use Doctrine\ORM\Query;

interface Specification
{
    public function match(QueryBuilder $qb, $dqlAlias);

    public function supports($className);
}