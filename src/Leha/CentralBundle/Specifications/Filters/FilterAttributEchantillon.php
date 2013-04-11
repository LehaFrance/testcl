<?php
namespace Leha\CentralBundle\Specifications\Filters;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query;

class FilterAttributRequete implements Specification
{
    private $attributRequete;

    public function __construct($attributRequete)
    {
        $this->attributRequte = $attributRequete;
    }

    public function match(QueryBuilder $qb, $dqlAlias)
    {
        $qb->setParameter('attribut_requete', $this->attributRequete);

        return $qb->expr()->eq($dqlAlias . '.attribut_requete', ':attribut_requete');
    }

    public function modifyQuery(Query $query)
    {

    }

    public function supports($className)
    {
        return ($className === 'Leha\CentralBundle\Entity\Echantillon');
    }
}