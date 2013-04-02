<?php
namespace Leha\HistoriqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Leha\HistoriqueBundle\Model\CritereInterface;

/**
 * CritereString
 *
 * @ORM\Entity
 */

class CritereString extends Critere implements CritereInterface
{
    public function getTypeCritere()
    {
        return 'text';
    }
}