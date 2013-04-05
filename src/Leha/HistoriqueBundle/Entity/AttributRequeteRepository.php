<?php

namespace Leha\HistoriqueBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * AttributRequeteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AttributRequeteRepository extends EntityRepository
{
	public function getByRequeteType(Requete $requete, $type)
	{
        $attributs_requete = $this->getEntityManager()->createQuery('select ar, a from LehaHistoriqueBundle:AttributRequete ar join ar.attribut a where ar.requete_id = :requete_id and ar.type = :type order by ar.ordre')
            ->setParameter('requete_id', $requete->getId())
            ->setParameter('type', $type)
            ->getResult();

		return $attributs_requete;
	}

    public function getAttributsDisponibles(Requete $requete)
    {
        $attributs_requete = $this->getEntityManager()->createQuery("select a from LehaAttributBundle:Attribut a left join a.attribut_requetes ar with ar.requete_id = :requete_id and ar.type = :type where ar.requete_id is null")
            ->setParameter('requete_id', $requete->getId())
            ->setParameter('type', AttributRequete::ATTRIBUT_REQUETE_FORM)
            ->getResult();

        return $attributs_requete;
    }
}
