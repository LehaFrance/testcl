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
     * @ORM\ManyToOne(targetEntity="Leha\UserBundle\Entity\Utilisateur", inversedBy="requetes")
     * @ORM\JoinColumn(name="utilisateur_id", referencedColumnName="id")
     */
    protected $utilisateur;

    /**
     * @ORM\OneToMany(targetEntity="Leha\HistoriqueBundle\Entity\AttributRequete", mappedBy="requete")
	 * @ORM\OrderBy({"ordre" = "ASC"})
     */
    protected $requete_attributs;

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
        $this->requete_attributs = new \Doctrine\Common\Collections\ArrayCollection();
    }
   
    /**
     * Add requete_attributs
     *
     * @param \Leha\HistoriqueBundle\Entity\AttributRequete $attributsRequete
     * @return Requete
     */
    public function addAttributsRequete(\Leha\HistoriqueBundle\Entity\AttributRequete $attributsRequete)
    {
        $this->requete_attributs[] = $attributsRequete;
    
        return $this;
    }

    /**
     * Remove requete_attributs
     *
     * @param \Leha\HistoriqueBundle\Entity\AttributRequete $attributsRequete
     */
    public function removeAttributsRequete(\Leha\HistoriqueBundle\Entity\AttributRequete $attributsRequete)
    {
        $this->requete_attributs->removeElement($attributsRequete);
    }

    /**
     * Get requete_attributs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAttributsRequete()
    {
        return $this->requete_attributs;
    }

    /**
     * Add requete_attributs
     *
     * @param \Leha\HistoriqueBundle\Entity\AttributRequete $requeteAttributs
     * @return Requete
     */
    public function addRequeteAttribut(\Leha\HistoriqueBundle\Entity\AttributRequete $requeteAttributs)
    {
        $this->requete_attributs[] = $requeteAttributs;
    
        return $this;
    }

    /**
     * Remove requete_attributs
     *
     * @param \Leha\HistoriqueBundle\Entity\AttributRequete $requeteAttributs
     */
    public function removeRequeteAttribut(\Leha\HistoriqueBundle\Entity\AttributRequete $requeteAttributs)
    {
        $this->requete_attributs->removeElement($requeteAttributs);
    }

    /**
     * Get requete_attributs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRequeteAttributs()
    {
        return $this->requete_attributs;
    }
}