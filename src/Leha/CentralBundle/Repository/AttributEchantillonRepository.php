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
     * @param int $echantillonId
     *
     * @return DoctrineCollection
     */
    public function findByNameAndEchantillonId($name, $echantillonId)
    {
        return true;
    }
}