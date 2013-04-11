<?php
namespace Leha\CentralBundle\Tests\Helper;

use Phake;
use Leha\CentralBundle\Entity\Attribut;

/**
 * Helper des tests historiques
 * @package Leha\CentralBundle\Tests\Helper
 */
class HelperHistory
{
    /**
     * Retourne une liste d'attribute_requete
     * @return array
     */
    static public function getAttributsRequete()
    {
        $attributRequete = array();

        $a1 = Phake::mock('Leha\CentralBundle\Entity\AttributString');
        Phake::when($a1)->getFieldId()->thenReturn('ATTR_8');
        Phake::when($a1)->getType()->thenReturn('text');
        Phake::when($a1)->getFieldOptions()->thenReturn(array());
        Phake::when($a1)->getScope()->thenReturn(Attribut::SCOPE_ECHANTILLON);
        Phake::when($a1)->getName()->thenReturn('itm8');

        $at1 = Phake::mock('Leha\HistoriqueBundle\Entity\AttributRequete');
        Phake::when($at1)->getAttribut()->thenReturn($a1);
        $attributRequete[] = $at1;

        return $attributRequete;
    }
}