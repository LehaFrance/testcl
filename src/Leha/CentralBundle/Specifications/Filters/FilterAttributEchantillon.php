<?php
namespace Leha\CentralBundle\Specifications\Filters;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query;

class FilterAttributEchantillon implements Specification
{
    private $attributEchantillon;

    public function __construct($attributEchantillon)
    {
        $this->attributEchantillon = $attributEchantillon;
    }

    public function match(QueryBuilder $qb, $dqlAlias)
    {
        $qb->setParameter('value', $this->attributEchantillon->getValue());
        $qb->setParameter('attribut', $this->attributEchantillon->getAttribut());

        $qb->innerJoin($dqlAlias . '.echantillonAttributs', 'ea', 'WITH', 'ea.attribut = :attribut and ea.value = :value');

        return "1 = 1";
    }

    public function modifyQuery(Query $query)
    {

    }

    public function supports($className)
    {
        return ($className === 'Leha\CentralBundle\Entity\AttributEchantillon');
    }
}