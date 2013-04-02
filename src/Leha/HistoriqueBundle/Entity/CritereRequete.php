<?php

namespace Leha\HistoriqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CritereRequete
 *
 * @ORM\Table(name="t_criteres_requetes")
 * @ORM\Entity(repositoryClass="Leha\HistoriqueBundle\Entity\CritereRequeteRepository")
 */
class CritereRequete
{
    /**
	 * @ORM\Id
	 * @ORM\ManyToOne(targetEntity="Leha\HistoriqueBundle\Entity\Critere", inversedBy="criteres_requete")
	 * @ORM\JoinColumn(name="critere_id", referencedColumnName="id")
	 */
    protected $critere;

    /**
	 * @ORM\Id
	 * @ORM\ManyToOne(targetEntity="Leha\HistoriqueBundle\Entity\Requete", inversedBy="criteres_requete")
	 * @ORM\JoinColumn(name="requete_id", referencedColumnName="id")
	 */
    protected $requete;
	
	/**
	 * @ORM\Column(name="critere_id", type="integer")
	 */
	protected $critere_id;

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
     * @return CritereRequete
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
     * Set critere
     *
     * @param \Leha\HistoriqueBundle\Entity\Critere $critere
     * @return CritereRequete
     */
    public function setCritere(\Leha\HistoriqueBundle\Entity\Critere $critere)
    {
        $this->critere = $critere;
    
        return $this;
    }

    /**
     * Get critere
     *
     * @return \Leha\HistoriqueBundle\Entity\Critere 
     */
    public function getCritere()
    {
        return $this->critere;
    }

    /**
     * Set requete
     *
     * @param \Leha\HistoriqueBundle\Entity\Requete $requete
     * @return CritereRequete
     */
    public function setRequete(\Leha\HistoriqueBundle\Entity\Requete $requete)
    {
        $this->requete = $requete;
    
        return $this;
    }

    /**
     * Get requete
     *
     * @return \Leha\HistoriqueBundle\Entity\Requete 
     */
    public function getRequete()
    {
        return $this->requete;
    }

    /**
     * Set critere_id
     *
     * @param integer $critereId
     * @return CritereRequete
     */
    public function setCritereId($critereId)
    {
        $this->critere_id = $critereId;
    
        return $this;
    }

    /**
     * Get critere_id
     *
     * @return integer 
     */
    public function getCritereId()
    {
        return $this->critere_id;
    }

    /**
     * Set requete_id
     *
     * @param integer $requeteId
     * @return CritereRequete
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
}