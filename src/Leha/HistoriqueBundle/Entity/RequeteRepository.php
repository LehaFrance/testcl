<?php

namespace Leha\HistoriqueBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * RequeteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RequeteRepository extends EntityRepository
{
    public function getCriteresDisponibles(Requete $requete)
    {
        $rsm = new ResultSetMapping;
        $rsm->addEntityResult('LehaHistoriqueBundle:Critere', 'c');
        $rsm->addFieldResult('c', 'id', 'id');
        $rsm->addFieldResult('c', 'libelle', 'libelle');
        $rsm->addFieldResult('c', 'type', 'type');

        $query = $this->getEntityManager()->createNativeQuery("select c.id, c.libelle from t_criteres c left join t_criteres_requetes cr on c.id = cr.critere_id and cr.requete_id = ? where cr.requete_id is null", $rsm);

        $query->setParameter(1, $requete->getId());

        $criteres = $query->getResult();

        return $criteres;
    }
}
