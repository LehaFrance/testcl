<?php

namespace Leha\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\OneToMany(targetEntity="Leha\HistoriqueBundle\Entity\Requete", mappedBy="utilisateur")
     */
    protected $requetes;

    /**
     * @var array
     * @ORM\ManyToMany(targetEntity="Leha\UserBundle\Entity\Group")
     * @ORM\JoinTable(name="user_group",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;

    /**
     * @var string
     * @ORM\OneToMany(targetEntity="Leha\UserBundle\Entity\Type", mappedBy="t_user")
     */
    protected $type;

    public function __construct()
    {
       parent::__construct();
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
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param $type
     */
    public function setType($type)
    {
        $this->type=$type;
    }

}
