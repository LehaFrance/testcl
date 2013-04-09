<?php

namespace Leha\CentralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AttributEchantillon
 *
 * @ORM\Table(name="t_attributs_echantillons")
 * @ORM\Entity(repositoryClass="Leha\CentralBundle\Repository\AttributEchantillonRepository")
 */
class AttributEchantillon
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Leha\CentralBundle\Entity\Echantillon", inversedBy="echantillonAttributs")
     * @ORM\JoinColumn(name="echantillon_id", referencedColumnName="id")
     */
    protected $echantillon;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Leha\CentralBundle\Entity\Attribut", inversedBy="attributEchantillons")
     * @ORM\JoinColumn(name="attribut_id", referencedColumnName="id")
     */
    protected $attribut;

    /**
     * @ORM\Column(name="value", type="string", length=2000)
     */
    protected $value;

    /**
     * Set value
     *
     * @param string $value
     * @return AttributEchantillon
     */
    public function setValue($value)
    {
        $this->value = $value;
    
        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set echantillon
     *
     * @param \Leha\CentralBundle\Entity\Echantillon $echantillon
     * @return AttributEchantillon
     */
    public function setEchantillon(\Leha\CentralBundle\Entity\Echantillon $echantillon = null)
    {
        $this->echantillon = $echantillon;
    
        return $this;
    }

    /**
     * Get echantillon
     *
     * @return \Leha\CentralBundle\Entity\Echantillon 
     */
    public function getEchantillon()
    {
        return $this->echantillon;
    }

    /**
     * Set attribut
     *
     * @param \Leha\CentralBundle\Entity\Attribut $attribut
     * @return AttributEchantillon
     */
    public function setAttribut(\Leha\CentralBundle\Entity\Attribut $attribut = null)
    {
        $this->attribut = $attribut;
    
        return $this;
    }

    /**
     * Get attribut
     *
     * @return \Leha\CentralBundle\Entity\Attribut
     */
    public function getAttribut()
    {
        return $this->attribut;
    }
}