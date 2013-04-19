<?php
/**
 * @author oyacoubi <oyacoubi@leha-labo.com>
 */
namespace \Leha\UserBundle\Entity;

use Doctrine\ORM\Mapping;
use Leha\UserBundle\Entity\User as baseUser;

/**
 * Class UserClient
 * @ORM\Table(name="t_userclient")
 * @ORM\Entity
 */
class UserClient extends baseUser
{
    /**
     * @var
     */
    protected $client;
    /**
     * @var
     */
    protected $structTree;

    public function setClient($client)
    {
        $this->client = $client;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function setStructTree($structTree)
    {
        $this->structTree = $structTree;
    }

    public function getStructTree()
    {
        return $this->structTree;
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
