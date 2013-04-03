<?php

namespace Leha\AttributBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Leha\AttributBundle\Model\AttributInterface;

/**
 * Class AttributString
 * @package Leha\AttributBundle\Entity
 *
 * @ORM\Entity
 */
class AttributString extends Attribut implements AttributInterface
{
    public function getType()
    {
        return 'text';
    }
}