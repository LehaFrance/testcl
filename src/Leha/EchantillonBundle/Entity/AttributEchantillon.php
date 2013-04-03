<?php

namespace Leha\EchantillonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AttributEchantillon
 *
 * @ORM\Table(name="t_attributs_echantillons")
 * @ORM\Entity(repositoryClass="Leha\EchantillonBundle\Entity\AttributEchantillonRepository")
 */
class AttributEchantillon
{
    /**
     * @ORM\ManyToOne(targetEntity="Leha\EchantillonBundle\Entity\Echantillon", inversedBy="echantillon_attributs")
     * @ORM\JoinColumn(name="echantillon_id", referencedColumnName="id")
     */
    protected $echantillon;

    /**
     * @ORM\Id
     * @ORM\Column(name="echantillon_id", type="integer")
     */
    protected $echantillon_id;

    /**
     * @ORM\ManyToOne(targetEntity="Leha\AttributBundle\Entity\Attribut", inversedBy="attribut_echantillons")
     * @ORM\JoinColumn(name="attribut_id", referencedColumnName="id")
     */
    protected $attribut;

    /**
     * @ORM\Id
     * @ORM\Column(name="attribut_id", type="integer")
     */
    protected $attribut_id;

    /**
     * @ORM\Column(name="value", type="string", length=2000)
     */
    protected $value;

    /**
     * Set echantillon_id
     *
     * @param integer $echantillonId
     * @return AttributEchantillon
     */
    public function setEchantillonId($echantillonId)
    {
        $this->echantillon_id = $echantillonId;
    
        return $this;
    }

    /**
     * Get echantillon_id
     *
     * @return integer 
     */
    public function getEchantillonId()
    {
        return $this->echantillon_id;
    }

    /**
     * Set attribut_id
     *
     * @param integer $attributId
     * @return AttributEchantillon
     */
    public function setAttributId($attributId)
    {
        $this->attribut_id = $attributId;
    
        return $this;
    }

    /**
     * Get attribut_id
     *
     * @return integer 
     */
    public function getAttributId()
    {
        return $this->attribut_id;
    }

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
     * @param \Leha\EchantillonBundle\Entity\Echantillon $echantillon
     * @return AttributEchantillon
     */
    public function setEchantillon(\Leha\EchantillonBundle\Entity\Echantillon $echantillon = null)
    {
        $this->echantillon = $echantillon;
    
        return $this;
    }

    /**
     * Get echantillon
     *
     * @return \Leha\EchantillonBundle\Entity\Echantillon 
     */
    public function getEchantillon()
    {
        return $this->echantillon;
    }

    /**
     * Set attribut
     *
     * @param \Leha\AttributBundle\Entity\Attribut $attribut
     * @return AttributEchantillon
     */
    public function setAttribut(\Leha\AttributBundle\Entity\Attribut $attribut = null)
    {
        $this->attribut = $attribut;
    
        return $this;
    }

    /**
     * Get attribut
     *
     * @return \Leha\AttributBundle\Entity\Attribut
     */
    public function getAttribut()
    {
        return $this->attribut;
    }
}