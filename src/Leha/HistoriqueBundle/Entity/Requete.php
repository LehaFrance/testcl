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
     * @ORM\ManyToMany(targetEntity="Leha\HistoriqueBundle\Entity\Critere")
     * @ORM\JoinTable(name="t_criteres_requetes")
     */
    protected $criteres;

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
        $this->criteres = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add criteres
     *
     * @param \Leha\HistoriqueBundle\Entity\Critere $critere
     * @return Requete
     */
    public function addCritere(\Leha\HistoriqueBundle\Entity\Critere $critere)
    {
        $this->criteres[] = $critere;
    
        return $this;
    }

    /**
     * Remove criteres
     *
     * @param \Leha\HistoriqueeBundle\Entity\Critere $critere
     */
    public function removeCritere(\Leha\HistoriqueBundle\Entity\Critere $critere)
    {
        $this->criteres->removeElement($critere);
    }

    /**
     * Get criteres
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCriteres()
    {
        return $this->criteres;
    }
}