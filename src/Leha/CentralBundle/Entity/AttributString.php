<?php

namespace Leha\CentralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Leha\CentralBundle\Model\AttributInterface;

/**
 * Class AttributString
 * @package Leha\CentralBundle\Entity
 *
 * @ORM\Entity
 */
class AttributString extends Attribut implements AttributInterface
{
    /**
     * Retourne le type de champ
     *
     * @return string
     */
    public function getType()
    {
        return 'text';
    }
}