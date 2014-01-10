<?php
/**
 * @author oyacoubi <oyacoubi@leha-labo.com>
 */
namespace Leha\UserBundle\Entity;

use FOS\UserBundle\Entity\Group as BaseGroup;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections as Collection;


/**
 * Group
 *
 * @ORM\Table(name="t_Group")
 * @ORM\Entity
 */
class Group extends BaseGroup
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @var
     * @ORM\ManyToMany(targetEntity="Leha\UserBundle\Entity\User", inversedBy="groups")
     * @ORM\JoinTable(name="group_users")
     */
    protected $users;

    /**
     * @var DateTime
     * @ORM\Column(name="date_creation" ,type="datetime")
     */
    protected $createAt;

    /**
     * Constructeur parent
     * @param $name
     * @param array $roles
     */
    public function __construct()
    {
        $this->createAt = new \DateTime('now');
        $this->users = new Collection\ArrayCollection();
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
     * @param \Leha\UserBundle\Entity\User  $users
     */
    public function setUsers(\Leha\UserBundle\Entity\User $users)
    {
        $this->users = $users;
    }

    /**
     * @return \Leha\UserBundle\Entity\User $users
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

    public function __toString()
    {
        return (isset($this->name))?$this->name:'';
    }




}
