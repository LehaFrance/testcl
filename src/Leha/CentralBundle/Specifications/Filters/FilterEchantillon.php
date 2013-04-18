<?php
namespace Leha\CentralBundle\Specifications\Filters;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query;

class FilterEchantillon implements Specification
{
    private $propertyField;
    private $propertyValue;

    public function __construct($propertyField, $propertyValue)
    {
        $this->propertyField = $propertyField;
        $this->propertyValue = $propertyValue;
    }

    public function match(QueryBuilder $qb, $dqlAlias)
    {
        $qb->setParameter('param', $this->propertyValue);

        return $qb->expr()->eq($dqlAlias . '.' . $this->propertyField, ':param');
    }

    public function supports($className)
    {
        return ($className === 'Leha\CentralBundle\Entity\AttributEchantillon');
    }
}