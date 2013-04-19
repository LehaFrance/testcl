<?php
/**
 * @author oyacoubi <oyacoubi@leha-labo.com>
 */
namespace Leha\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Leha\UserBundle\Entity\User as baseUser;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections;

/**
 * Class UserClient
 *
 * @ORM\Table(name="t_userclient")
 * @ORM\Entity
 */
class UserClient extends baseUser
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\generatedValue(strategy="AUTO")
     *
     */
    protected $id;
    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Leha\ClientBundle\Entity\Client", inversedBy="users", cascade={"remove"})
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    protected  $client;

    /**
     * @var
     */
    protected $structTree;



    /**
     * @param $client
     */

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
