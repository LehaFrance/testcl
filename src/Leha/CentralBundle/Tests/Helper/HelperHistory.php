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

        $a1 = Phake::mock('Leha\CentralBundle\Entity\AttributChoice');
        Phake::when($a1)->getType()->thenReturn('choice');
        Phake::when($a1)->getFieldOptions()->thenReturn(array(
            'label' => 'Etat réception',
            'required' => false,
            'choices' => array(
                'En attente' => 'En attente',
                'Anomalie' => 'Anomalie',
                'Reçu' => 'Reçu',
                'Abandonne' => 'Abandonne'
            ),
            'empty_value' => ''
        ));
        Phake::when($a1)->getScope()->thenReturn(Attribut::SCOPE_ECHANTILLON);
        Phake::when($a1)->getName()->thenReturn('etatReception');

        $at1 = Phake::mock('Leha\CentralBundle\Entity\AttributRequete');
        Phake::when($at1)->getAttribut()->thenReturn($a1);
        $attributRequete[] = $at1;

        $a2 = Phake::mock('Leha\CentralBundle\Entity\AttributString');
        Phake::when($a2)->getType()->thenReturn('text');
        Phake::when($a2)->getFieldOptions()->thenReturn(array(
            'label' => 'ITM8',
            'required' => false
        ));
        Phake::when($a2)->getScope()->thenReturn(Attribut::SCOPE_ATTRIBUT);
        Phake::when($a2)->getName()->thenReturn('itm8');

        $at2 = Phake::mock('Leha\CentralBundle\Entity\AttributRequete');
        Phake::when($at2)->getAttribut()->thenReturn($a2);
        $attributRequete[] = $at2;

        return $attributRequete;
    }
}