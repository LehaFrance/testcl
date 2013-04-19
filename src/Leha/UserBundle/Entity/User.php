<?php

namespace Leha\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections;

/**
 * User
 *
 * @ORM\Table(name="t_user")
 * @ORM\Entity
 */
class User extends BaseUSer
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var
     * @ORM\Column(name="nom", type="string", length=50)
     * @Assert\NotBlank()
     */
    protected $firstName;

    /**
     * @var
     * @ORM\Column(name="prenom", type="string", length=50)
     * @Assert\NotBlank()
     */
    protected $lastName;

    /**

     * @var
     * @ORM\Column(name="date_naissance", type="date")
     */
    private $dateOfBirth;

    /**
     * @var
     * @ORM\Column(name="pays", type="string", length=100)
     */
    protected $country;

    /**
     * @ORM\OneToMany(targetEntity="Leha\CentralBundle\Entity\Requete", mappedBy="utilisateur")
     */
    protected $requetes;

    /**
     * @var array
     * @ORM\ManyToMany(targetEntity="Leha\UserBundle\Entity\Group", mappedBy="users")
     */
    protected $groups;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Leha\UserBundle\Entity\Type", inversedBy="users", cascade={"remove"})
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    protected $type;

    /**
     * @var string
     * @ORM\Column(name="civilite", type="string", length=50)
     */
    protected $civility;

    public function __construct()
    {
        parent::__construct();
        $this->groups = new Collections\ArrayCollection();
    }

    /**
     * @param  $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param  $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return
     */
    public function getLastName()
    {
        return $this->lastName;
    }



    /**
     * Add requetes
     *
     * @param \Leha\CentralBundle\Entity\Requete $requetes
     * @return Utilisateur
     */
    public function addRequete(\Leha\CentralBundle\Entity\Requete $requetes)
    {
        $this->requetes[] = $requetes;

        return $this;
    }

    /**
     * Remove requetes
     *
     * @param \Leha\CentralBundle\Entity\Requete $requetes
     */
    public function removeRequete(\Leha\CentralBundle\Entity\Requete $requetes)
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

    /**
     * @return
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * @return
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * @return
     */
    public function getcountry()
    {
        return $this->country;
    }

    /**
     * @return
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }
    /**
     * @return \Leha\UserBundle\Enity\Type $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param \Leha\UserBundle\Entity\Type
     */
    public function setType($type)
    {
        $this->type=$type;
    }

    /**
     * @param \Leha\UserBundle\Entity\Group $groups
     */
    public function setGroups(\Leha\UserBundle\Entity\Group $groups)
    {
        $this->groups[] = $groups;
    }

    /**
     * @return \Leha\UserBundle\Entity\Group $groups
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @param string
     */
    public function setCivility($civility)
    {
        $this->civility = $civility;
    }

    /**
     * @return string
     */
    public function getCivility()
    {
        return $this->civility;
    }

    public static function civilite()
    {

    }
}
