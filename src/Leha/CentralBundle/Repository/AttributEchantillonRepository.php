<?php

namespace Leha\CentralBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * La classe pour accèder à la couche model de EchantillonAttribute
 *
 * @package Leha\CentralBundle\Repository
 */
class AttributEchantillonRepository extends EntityRepository
{
    /**
     * La fonction cherche un AttributEchantillon à partir de l'id d'echantillon et le nom de l'attribut
     *
     * @param string $name
     * @param Leha\CentralBundle\Entity\Echantillon
     *
     * @return DoctrineCollection
     */
    public function findByNameAndEchantillon($name, $echantillon)
    {
        $query =  $this->createQueryBuilder('e')
            ->select()
            ->where('e.echantillon = :echantillonId')
            ->innerJoin('e.attribut','a')
            ->andWhere('a.name = :name')
            ->setParameters(array(
                ':echantillonId' => $echantillon->getId(),
                ':name' => $name,
            ))->getQuery();

            return $query->getSingleResult();
    }
}