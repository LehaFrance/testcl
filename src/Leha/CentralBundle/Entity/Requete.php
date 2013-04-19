<?php
namespace Leha\CentralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Requete
 * @package Leha\CentralBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="t_requetes")
 */
class Requete
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     */
    protected $libelle;

    /**
     * @ORM\ManyToOne(targetEntity="Leha\UserBundle\Entity\User", inversedBy="requetes")
     * @ORM\JoinColumn(name="utilisateur_id", referencedColumnName="id")
     */
    protected $utilisateur;

    /**
     * @ORM\OneToMany(targetEntity="Leha\CentralBundle\Entity\AttributRequete", mappedBy="requete", cascade={"remove"})
	 * @ORM\OrderBy({"ordre" = "ASC"})
     */
    protected $requeteAttributs;

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
     *
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
     * @param \Leha\UserBundle\Entity\User $utilisateur
     *
     * @return Requete
     */
    public function setUtilisateur(\Leha\UserBundle\Entity\User $utilisateur = null)
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
        $this->requeteAttributs = new \Doctrine\Common\Collections\ArrayCollection();
    }
   
    /**
     * Add requete_attributs
     *
     * @param \Leha\CentralBundle\Entity\AttributRequete $attributsRequete
     *
     * @return Requete
     */
    public function addAttributsRequete(\Leha\CentralBundle\Entity\AttributRequete $attributsRequete)
    {
        $this->requeteAttributs[] = $attributsRequete;
    
        return $this;
    }

    /**
     * Remove requete_attributs
     *
     * @param \Leha\CentralBundle\Entity\AttributRequete $attributsRequete
     */
    public function removeAttributsRequete(\Leha\CentralBundle\Entity\AttributRequete $attributsRequete)
    {
        $this->requeteAttributs->removeElement($attributsRequete);
    }

    /**
     * Get requete_attributs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAttributsRequete()
    {
        return $this->requeteAttributs;
    }

    /**
     * Add requete_attributs
     *
     * @param \Leha\CentralBundle\Entity\AttributRequete $requeteAttributs
     *
     * @return Requete
     */
    public function addRequeteAttribut(\Leha\CentralBundle\Entity\AttributRequete $requeteAttributs)
    {
        $this->requeteAttributs[] = $requeteAttributs;
    
        return $this;
    }

    /**
     * Remove requete_attributs
     *
     * @param \Leha\CentralBundle\Entity\AttributRequete $requeteAttributs
     */
    public function removeRequeteAttribut(\Leha\CentralBundle\Entity\AttributRequete $requeteAttributs)
    {
        $this->requeteAttributs->removeElement($requeteAttributs);
    }

    /**
     * Get requete_attributs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRequeteAttributs()
    {
        return $this->requeteAttributs;
    }
}