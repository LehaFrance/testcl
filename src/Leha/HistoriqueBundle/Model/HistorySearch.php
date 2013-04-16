<?php

namespace Leha\HistoriqueBundle\Model;

use Leha\CentralBundle\Entity\Attribut;

class HistorySearch
{
    public $attributesRequete;

    public $echantillonProperties;
    public $relatedAttributes;

    public function __construct($attributsRequete)
    {
        $this->attributesRequete = $attributsRequete;
    }

    public function setEchantillonProperties($echantillonProperties)
    {
        $this->echantillonProperties = $echantillonProperties;
    }

    public function getEchantillonProperties()
    {
        return $this->echantillonProperties;
    }

    public function setRelatedAttributes($relatedAttributes)
    {
        $this->relatedAttributes = $relatedAttributes;
    }

    public function getRelatedAttributes()
    {
        return $this->relatedAttributes;
    }
}
