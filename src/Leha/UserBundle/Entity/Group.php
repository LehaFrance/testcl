<?php
/**
 * @author oyacoubi <oyacoubi@leha-labo.com>
 */
namespace Leha\UserBundle\Entity;

use FOS\UserBundle\Entity\Group as BaseGroup;
use Doctrine\ORM\Mapping as ORM;


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
     * Constructeur parent
     * @param $name
     * @param array $roles
     */
    public function __construct($name = 'global', $roles = array())
    {
        parent::__construct($name, $roles);
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


}
