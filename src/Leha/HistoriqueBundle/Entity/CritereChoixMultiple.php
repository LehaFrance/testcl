<?php
namespace Leha\HistoriqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Leha\HistoriqueBundle\Model\CritereInterface;

/**
 * CritereChoixMultipe
 *
 * @ORM\Entity
 */

class CritereChoixMultiple extends Critere implements CritereInterface
{
    public function getTypeCritere()
    {
        return 'choice';
    }
    
    public function getFieldOptions()
    {
        $opts = parent::getFieldOptions();

        $get_options = explode(',', $this->getOptions());
        $options = array();
        foreach ($get_options as $option) {
            $options[$option] = $option;
        }

        $opts['choices'] = $options;
        $opts['empty_value'] = '';

        return $opts;
    }
}