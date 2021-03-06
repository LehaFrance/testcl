<?php

namespace Leha\CentralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Leha\UserBundle\Entity\User;

/**
 * Client
 *
 * @ORM\Table(name="t_clients")
 * @ORM\Entity(repositoryClass="Leha\CentralBundle\Repository\ClientRepository")
 */
class Client
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\ManyToMany(targetEntity="Leha\CentralBundle\Entity\Attribut", inversedBy="clients")
     * @ORM\JoinTable(name="t_attributs_clients",
     *      joinColumns={@ORM\JoinColumn(name="client_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="attribut_id", referencedColumnName="id")}
     *  )
     */
    private $attributs;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="Leha\UserBundle\Entity\UserClient", mappedBy="client", cascade={"remove","persist"})
     *
     */
    private $users;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->attributs = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     *
     * @return Client
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
     * @param  Leha\UserBundle\Entity\User $users
     */
    public function setUsers(User $users)
    {
        $this->users = $users;
    }

    /**
     * @return Leha\UserBundle\Entity\User
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @return string
     */
    public function  __toString()
    {
        return (isset ($this->nom))?$this->nom:"";
    }
}
