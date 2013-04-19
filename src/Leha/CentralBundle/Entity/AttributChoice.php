<?php

namespace Leha\CentralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Leha\CentralBundle\Model\AttributInterface;

/**
 * Class AttributChoice
 * @package Leha\CentralBundle\Entity
 *
 * @ORM\Entity
 */
class AttributChoice extends Attribut implements AttributInterface
{
    /**
     * Retourne le type de champ
     *
     * @return string
     */
    public function getType()
    {
        return 'choice';
    }

    /**
     * Retourne la liste des options utilisées pour la création du champ dans le formulaire
     *
     * @return array
     */
    public function getFieldOptions()
    {
        $opts = parent::getFieldOptions();

        $options = $this->getOptions();
        $opts['choices'] = $options['options'];
        $opts['empty_value'] = '';

        return $opts;
    }
}