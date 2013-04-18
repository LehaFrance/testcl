<?php
/**
 * @author oyacoubi <oyacoubi@leha-labo.com>
 */
namespace Leha\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections;
use \Doctrine\Common\Collections as Collection;

/**
 * Type
 *
 * @ORM\Table(name="t_type_user")
 * @ORM\Entity
 */
class Type
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="nom", type="string", length=100)
     */
    protected $name;

    /**
     * @var
     * @ORM\Column(name="Date_creation", type="datetime")
     */

    protected $createAt;

    /**
     * @var array
     * @ORM\OneToMany(targetEntity="Leha\UserBundle\Entity\User", mappedBy="type", cascade={"remove", "persist"})
     *
     */

    protected $users;

    /**
     * @var
     * @ORM\Column(name="actif", type="boolean")
     */
    protected $isActif;

    function __construct()
    {
        $this->createAt = new \DateTime('now');
        $this->users = new Collection\ArrayCollection();
        $this->isActif = true;
    }


    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param \Leha\UserBundle\Entity\User $users
     */
    public function addUsers(\Leha\UserBundle\Entity\User $users)
    {
        $this->users[] = $users;
    }

    /**
     *@param \Leha\UserBundle\Entity\User $users
     */

    public function setUser(\Leha\UserBundle\Entity\User $users)
    {
        $this->users = $users;
    }

    /**
     * @return array
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param  $createAt
     */
    public function setCreateAt($createAt)
    {
        $this->createAt = $createAt;
    }

    /**
     * @return
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * @param  $isActif
     */
    public function setIsActif($isActif)
    {
        $this->isActif = $isActif;
    }

    /**
     * @return
     */
    public function getIsActif()
    {
        return $this->isActif;
    }



    /**
     * @return string
     */
    public function __toString()
    {
        return (isset($this->name))?$this->name:'';
    }
}
