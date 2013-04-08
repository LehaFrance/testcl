<?php

namespace Leha\UserTestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;


/**
 * User
 *
 * @ORM\Table(name="t_user")
 * @ORM\Entity
 */
class User extends BaseUSer
{
    public function setRequetes($requetes)
    {
        $this->requetes = $requetes;
    }

    public function getRequetes()
    {
        return $this->requetes;
    }
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected  $id;

    public function __construct()
    {
       parent::__construct();
    }

    /**
     * @ORM\OneToMany(targetEntity="Leha\HistoriqueBundle\Entity\Requete", mappedBy="utilisateur")
     */
    protected $requetes;
}
