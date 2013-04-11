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
    public function getType()
    {
        return 'choice';
    }

    public function getFieldOptions()
    {
        $opts = parent::getFieldOptions();

        $options = $this->getOptions();
        $opts['choices'] = $options['options'];
        $opts['empty_value'] = '';

        return $opts;
    }
}