<?php
namespace Leha\HistoriqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Leha\HistoriqueBundle\Model\CritereInterface;

/**
 * CritereDate
 *
 * @ORM\Entity
 */

class CritereDate extends Critere implements CritereInterface
{
    public function getTypeCritere()
    {
        return 'date';
    }
}