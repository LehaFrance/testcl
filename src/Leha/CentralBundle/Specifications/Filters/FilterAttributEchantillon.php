<?php
namespace Leha\CentralBundle\Specifications\Filters;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query;

class FilterAttributEchantillon implements Specification
{
    private $attributEchantillon;
    private $indice;

    public function __construct($attributEchantillon, $indice)
    {
        $this->attributEchantillon = $attributEchantillon;
        $this->indice = $indice;
    }

    public function match(QueryBuilder $qb, $dqlAlias)
    {
        $qb->setParameter('value' . $this->indice, $this->attributEchantillon->getValue());
        $qb->setParameter('attribut' . $this->indice, $this->attributEchantillon->getAttribut());

        $qb->innerJoin($dqlAlias . '.echantillonAttributs', 'ea' . $this->indice, 'WITH', 'ea' . $this->indice . '.attribut = :attribut' . $this->indice . ' and ' . 'ea' . $this->indice . '.value = :value' . $this->indice);

        return  "1 = 1";
    }

    public function supports($className)
    {
        return ($className === 'Leha\CentralBundle\Entity\AttributEchantillon');
    }
}