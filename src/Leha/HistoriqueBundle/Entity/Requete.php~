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
     * @ORM\ManyToMany(targetEntity="Leha\AnalyseBundle\Entity\Analyse")
     * @ORM\JoinTable(name="t_analyses_requetes")
     */
    protected $analyses;

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
        $this->analyses = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add analyses
     *
     * @param \Leha\AnalyseBundle\Entity\Analyse $analyses
     * @return Requete
     */
    public function addAnalyse(\Leha\AnalyseBundle\Entity\Analyse $analyses)
    {
        $this->analyses[] = $analyses;
    
        return $this;
    }

    /**
     * Remove analyses
     *
     * @param \Leha\AnalyseBundle\Entity\Analyse $analyses
     */
    public function removeAnalyse(\Leha\AnalyseBundle\Entity\Analyse $analyses)
    {
        $this->analyses->removeElement($analyses);
    }

    /**
     * Get analyses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAnalyses()
    {
        return $this->analyses;
    }
}