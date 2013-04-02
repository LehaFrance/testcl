<?php

namespace Leha\HistoriqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Critere
 *
 * @ORM\Table(name="t_criteres")
 * @ORM\Entity
 */
class Critere
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=20)
     */
    private $type;
	
	/**
     * @ORM\OneToMany(targetEntity="Leha\HistoriqueBundle\Entity\CritereRequete", mappedBy="critere")
     */
    protected $criteres_requete;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return Critere
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    
        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Critere
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->criteres_requete = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add criteres_requete
     *
     * @param \Leha\HistoriqueBundle\Entity\CritereRequete $criteresRequete
     * @return Critere
     */
    public function addCriteresRequete(\Leha\HistoriqueBundle\Entity\CritereRequete $criteresRequete)
    {
        $this->criteres_requete[] = $criteresRequete;
    
        return $this;
    }

    /**
     * Remove criteres_requete
     *
     * @param \Leha\HistoriqueBundle\Entity\CritereRequete $criteresRequete
     */
    public function removeCriteresRequete(\Leha\HistoriqueBundle\Entity\CritereRequete $criteresRequete)
    {
        $this->criteres_requete->removeElement($criteresRequete);
    }

    /**
     * Get criteres_requete
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCriteresRequete()
    {
        return $this->criteres_requete;
    }
}