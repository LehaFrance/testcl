<?php

namespace Leha\CentralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AttributRequete
 *
 * @ORM\Table(name="t_attributs_requetes")
 * @ORM\Entity(repositoryClass="Leha\CentralBundle\Repository\AttributRequeteRepository")
 */
class AttributRequete
{
    Const ATTRIBUT_REQUETE_FORM = 'form';
    Const ATTRIBUT_REQUETE_GRID = 'grid';

    /**
	 * @ORM\Id
	 * @ORM\ManyToOne(targetEntity="Leha\CentralBundle\Entity\Attribut", inversedBy="attributRequetes")
	 * @ORM\JoinColumn(name="attribut_id", referencedColumnName="id")
	 */
    protected $attribut;

    /**
	 * @ORM\Id
	 * @ORM\ManyToOne(targetEntity="Leha\CentralBundle\Entity\Requete", inversedBy="requete_attributs")
	 * @ORM\JoinColumn(name="requete_id", referencedColumnName="id")
	 */
    protected $requete;

    /**
     * @ORM\Id
     * @var string
     *
     * @ORM\Column(name="type", columnDefinition="ENUM('form', 'grid')")
     */
    private $type;

	/**
	 * @ORM\Column(name="attribut_id", type="integer")
	 */
	protected $attribut_id;

	/**
	 * @ORM\Column(name="requete_id", type="integer")
	 */
	protected $requete_id;

    /**
     * @var integer
     *
     * @ORM\Column(name="ordre", type="integer")
     */
    protected $ordre;

    /**
     * Set ordre
     *
     * @param integer $ordre
     * @return AttributRequete
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return integer
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    /**
     * Set attribut
     *
     * @param \Leha\CentralBundle\Entity\Attribut $attribut
     * @return AttributRequete
     */
    public function setAttribut(\Leha\CentralBundle\Entity\Attribut $attribut)
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

    /**
     * Set requete
     *
     * @param \Leha\CentralBundle\Entity\Requete $requete
     * @return AttributRequete
     */
    public function setRequete(\Leha\CentralBundle\Entity\Requete $requete)
    {
        $this->requete = $requete;

        return $this;
    }

    /**
     * Get requete
     *
     * @return \Leha\CentralBundle\Entity\Requete
     */
    public function getRequete()
    {
        return $this->requete;
    }

    /**
     * Set attribut_id
     *
     * @param integer $attributId
     * @return AttributRequete
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
     * Set requete_id
     *
     * @param integer $requeteId
     * @return AttributRequete
     */
    public function setRequeteId($requeteId)
    {
        $this->requete_id = $requeteId;
    
        return $this;
    }

    /**
     * Get requete_id
     *
     * @return integer 
     */
    public function getRequeteId()
    {
        return $this->requete_id;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return AttributRequete
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }
}