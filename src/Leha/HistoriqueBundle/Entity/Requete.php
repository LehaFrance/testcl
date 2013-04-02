<?php
namespace Leha\HistoriqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Requete
 * @package Leha\HistoriqueBundle\Entity
 * @ORM\Entity(repositoryClass="Leha\HistoriqueBundle\Entity\RequeteRepository")
 * @ORM\Table(name="t_requetes")
 */
class Requete
{
    /**
     * @var
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     */
    protected $libelle;

    /**
     * @ORM\ManyToOne(targetEntity="Leha\UserBundle\Entity\Utilisateur", inversedBy="requetes")
     * @ORM\JoinColumn(name="utilisateur_id", referencedColumnName="id")
     */
    protected $utilisateur;

    /**
     * @ORM\OneToMany(targetEntity="Leha\HistoriqueBundle\Entity\CritereRequete", mappedBy="requete")
	 * @ORM\OrderBy({"ordre" = "ASC"})
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
     * @return Requete
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
     * Set utilisateur
     *
     * @param \Leha\UserBundle\Entity\Utilisateur $utilisateur
     * @return Requete
     */
    public function setUtilisateur(\Leha\UserBundle\Entity\Utilisateur $utilisateur = null)
    {
        $this->utilisateur = $utilisateur;
    
        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \Leha\UserBundle\Entity\Utilisateur 
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
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
     * @return Requete
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