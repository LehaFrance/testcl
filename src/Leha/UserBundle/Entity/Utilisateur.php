<?php
namespace Leha\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class Utilisateur
 * @package Leha\UserBundle\Entity
 * @ORM\Entity(repositoryClass="Leha\UserBundle\Entity\UtilisateurRepository")
 * @ORM\Table(name="t_utilisateurs")
 */
class Utilisateur implements UserInterface
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
    protected $nom;

    /**
     * @var
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     */
    protected $prenom;

    /**
     * @var
     * @ORM\Column(name="username", type="string", length=50)
     * @Assert\NotBlank()
     */
    protected $username;

    /**
     * @var
     * @ORM\Column(name="password", type="string", length=50)
     * @Assert\NotBlank()
     */
    protected $password;
	
	/**
     * @ORM\Column(name="salt", type="string", length=255)
     */
    protected $salt;
	
	/**
     * @ORM\Column(name="roles", type="array")
     */
    protected $roles;

    /**
     * @ORM\OneToMany(targetEntity="Leha\HistoriqueBundle\Entity\Requete", mappedBy="utilisateur")
     */
    protected $requetes;

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
     * Set nom
     *
     * @param string $nom
     * @return Utilisateur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return Utilisateur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    
        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Utilisateur
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Utilisateur
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return Utilisateur
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    
        return $this;
    }

    /**
     * Set roles
     *
     * @param array $roles
     * @return Utilisateur
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    
        return $this;
    }

    public function __construct()
    {
        $this->requetes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add requetes
     *
     * @param \Leha\HistoriqueBundle\Entity\Requete $requetes
     * @return Utilisateur
     */
    public function addRequete(\Leha\HistoriqueBundle\Entity\Requete $requetes)
    {
        $this->requetes[] = $requetes;
    
        return $this;
    }

    /**
     * Remove requetes
     *
     * @param \Leha\HistoriqueBundle\Entity\Requete $requetes
     */
    public function removeRequete(\Leha\HistoriqueBundle\Entity\Requete $requetes)
    {
        $this->requetes->removeElement($requetes);
    }

    /**
     * Get requetes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRequetes()
    {
        return $this->requetes;
    }
}